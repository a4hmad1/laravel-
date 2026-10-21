<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected DwilioService $dwilio;

    public function __construct(DwilioService $dwilio)
    {
        $this->dwilio = $dwilio;
    }

    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login authentication.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Please enter your phone number or email address.',
            'password.required' => 'Please enter your password.',
        ]);

        $loginInput = trim($request->input('login'));
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Check if the input looks like an email or a phone number
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            $user = User::where('email', $loginInput)->first();
        } else {
            $normalizedPhone = $this->dwilio->normalizePhone($loginInput);
            $user = User::where('phone', $normalizedPhone)
                ->orWhere('phone', $loginInput)
                ->first();
        }

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['The provided credentials do not match our records.'],
            ]);
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))
            ->with('status', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Show registration form.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Handle initial registration request.
     * Verifies that the phone number is available on WhatsApp by sending an OTP.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:8', 'max:25'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'phone.required' => 'A WhatsApp phone number is required to register.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $normalizedPhone = $this->dwilio->normalizePhone($request->input('phone'));

        // Check if already registered
        $existingUser = User::where('phone', $normalizedPhone)->first();
        if ($existingUser && $existingUser->phone_verified_at) {
            return back()->withInput()->withErrors([
                'phone' => 'An account is already registered with this WhatsApp phone number. Please log in.',
            ]);
        }

        // Send OTP via WhatsApp to verify availability
        $otpResult = $this->dwilio->sendOtp($normalizedPhone, 'whatsapp');

        if (!$otpResult['success']) {
            return back()->withInput()->withErrors([
                'phone' => 'WhatsApp verification failed: ' . ($otpResult['error'] ?? 'Number is not available on WhatsApp.'),
            ]);
        }

        // Store registration info in session temporarily
        session([
            'pending_registration' => [
                'name' => $request->input('name'),
                'phone' => $normalizedPhone,
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'otp_sent_at' => now()->timestamp,
            ],
        ]);

        return redirect()->route('register.verify')
            ->with('status', "A 6-digit verification code has been sent to your WhatsApp ({$normalizedPhone}).");
    }

    /**
     * Show OTP verification form for registration.
     */
    public function showRegisterVerify()
    {
        $pending = session('pending_registration');

        if (!$pending) {
            return redirect()->route('register')
                ->withErrors(['phone' => 'Session expired. Please fill out the registration form again.']);
        }

        return view('auth.register-verify', [
            'phone' => $pending['phone'],
            'name' => $pending['name'],
        ]);
    }

    /**
     * Verify OTP and finalize user registration.
     */
    public function verifyRegisterOtp(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'min:4', 'max:10'],
        ], [
            'code.required' => 'Please enter the OTP verification code received on WhatsApp.',
        ]);

        $pending = session('pending_registration');

        if (!$pending) {
            return redirect()->route('register')
                ->withErrors(['phone' => 'Session expired. Please start registration again.']);
        }

        $verifyResult = $this->dwilio->verifyOtp($pending['phone'], $request->input('code'));

        if (!$verifyResult['success']) {
            return back()->withErrors([
                'code' => $verifyResult['error'] ?? 'Invalid verification code. Please try again.',
            ]);
        }

        // Create or update the user record
        $user = User::updateOrCreate(
            ['phone' => $pending['phone']],
            [
                'name' => $pending['name'],
                'email' => $pending['email'],
                'password' => $pending['password'],
                'phone_verified_at' => now(),
            ]
        );

        session()->forget('pending_registration');
        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('status', 'Registration complete! Your WhatsApp number has been verified.');
    }

    /**
     * Resend OTP for registration.
     */
    public function resendRegisterOtp()
    {
        $pending = session('pending_registration');

        if (!$pending) {
            return redirect()->route('register');
        }

        $result = $this->dwilio->sendOtp($pending['phone'], 'whatsapp');

        if (!$result['success']) {
            return back()->withErrors([
                'code' => 'Failed to resend code: ' . ($result['error'] ?? 'WhatsApp service error.'),
            ]);
        }

        return back()->with('status', 'A new verification code has been sent to your WhatsApp.');
    }

    /**
     * Show forgot password form.
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send OTP for password reset.
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
        ], [
            'phone.required' => 'Please enter your registered WhatsApp phone number.',
        ]);

        $normalizedPhone = $this->dwilio->normalizePhone($request->input('phone'));

        $user = User::where('phone', $normalizedPhone)
            ->orWhere('phone', $request->input('phone'))
            ->first();

        if (!$user) {
            return back()->withInput()->withErrors([
                'phone' => 'No account was found with this WhatsApp phone number.',
            ]);
        }

        $otpResult = $this->dwilio->sendOtp($normalizedPhone, 'whatsapp');

        if (!$otpResult['success']) {
            return back()->withInput()->withErrors([
                'phone' => 'Could not send WhatsApp OTP: ' . ($otpResult['error'] ?? 'Service error.'),
            ]);
        }

        session([
            'reset_phone' => $normalizedPhone,
            'reset_user_id' => $user->id,
        ]);

        return redirect()->route('password.verify')
            ->with('status', "A 6-digit password reset code was sent to your WhatsApp ({$normalizedPhone}).");
    }

    /**
     * Show password reset verification form.
     */
    public function showResetPasswordVerify()
    {
        $resetPhone = session('reset_phone');

        if (!$resetPhone) {
            return redirect()->route('password.request')
                ->withErrors(['phone' => 'Please request a password reset first.']);
        }

        return view('auth.reset-password', [
            'phone' => $resetPhone,
        ]);
    }

    /**
     * Verify OTP and reset password.
     */
    public function verifyAndResetPassword(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'min:4', 'max:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'code.required' => 'Please enter the verification code sent to your WhatsApp.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $resetPhone = session('reset_phone');

        if (!$resetPhone) {
            return redirect()->route('password.request')
                ->withErrors(['phone' => 'Reset session has expired. Please try again.']);
        }

        $verifyResult = $this->dwilio->verifyOtp($resetPhone, $request->input('code'));

        if (!$verifyResult['success']) {
            return back()->withErrors([
                'code' => $verifyResult['error'] ?? 'Invalid or expired OTP code.',
            ]);
        }

        $user = User::where('phone', $resetPhone)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['phone' => 'User not found.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        session()->forget(['reset_phone', 'reset_user_id']);

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully! You can now log in.');
    }

    /**
     * Resend OTP for password reset.
     */
    public function resendResetOtp()
    {
        $resetPhone = session('reset_phone');

        if (!$resetPhone) {
            return redirect()->route('password.request');
        }

        $result = $this->dwilio->sendOtp($resetPhone, 'whatsapp');

        if (!$result['success']) {
            return back()->withErrors([
                'code' => 'Failed to resend code: ' . ($result['error'] ?? 'WhatsApp service error.'),
            ]);
        }

        return back()->with('status', 'A new reset code has been sent to your WhatsApp.');
    }

    /**
     * Dashboard page for authenticated users.
     */
    public function dashboard()
    {
        return view('dashboard', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'You have been logged out.');
    }
}
