<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\DwilioService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Welcome Back');
        $response->assertSee('WhatsApp Phone Number or Email');
    }

    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Create Your Account');
        $response->assertSee('WhatsApp Phone Number');
    }

    public function test_forgot_password_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
        $response->assertSee('Forgot Password?');
        $response->assertSee('Send WhatsApp Reset Code');
    }

    public function test_registration_initiates_whatsapp_otp(): void
    {
        Http::fake([
            'https://api.dwilio.com/api/sms' => Http::response([
                'messageId' => 'test-message-123',
                'status' => 'pending',
                'channel' => 'whatsapp',
                'cost' => 25,
            ], 202),
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'phone' => '07701234567',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/register/verify');
        $this->assertTrue(session()->has('pending_registration'));
        $this->assertEquals('9647701234567', session('pending_registration.phone'));
    }

    public function test_registration_verifies_otp_and_authenticates_user(): void
    {
        Http::fake([
            'https://api.dwilio.com/api/verify' => Http::response([
                'verified' => true,
            ], 200),
            'https://api.dwilio.com/api/balance' => Http::response([
                'name' => 'test',
                'balance' => 956,
                'currency' => 'IQD',
            ], 200),
        ]);

        $this->withSession([
            'pending_registration' => [
                'name' => 'Test User',
                'phone' => '9647701234567',
                'email' => 'test@example.com',
                'password' => Hash::make('password123'),
                'otp_sent_at' => now()->timestamp,
            ],
        ]);

        $response = $this->post('/register/verify', [
            'code' => '123456',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'phone' => '9647701234567',
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_can_login_with_phone_and_password(): void
    {
        $user = User::create([
            'name' => 'Ahmed User',
            'phone' => '9647709876543',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('secret123'),
            'phone_verified_at' => now(),
        ]);

        // Login using Iraqi local format 07709876543
        $response = $this->post('/login', [
            'login' => '07709876543',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_forgot_password_sends_otp_and_resets_password(): void
    {
        $user = User::create([
            'name' => 'Reset Tester',
            'phone' => '9647801122334',
            'password' => Hash::make('oldpassword'),
            'phone_verified_at' => now(),
        ]);

        Http::fake([
            'https://api.dwilio.com/api/sms' => Http::response([
                'messageId' => 'reset-msg-456',
                'status' => 'pending',
                'channel' => 'whatsapp',
            ], 202),
            'https://api.dwilio.com/api/verify' => Http::response([
                'verified' => true,
            ], 200),
        ]);

        // Request reset OTP
        $response = $this->post('/forgot-password', [
            'phone' => '07801122334',
        ]);

        $response->assertRedirect('/reset-password');
        $this->assertEquals('9647801122334', session('reset_phone'));

        // Submit new password with OTP code
        $resetResponse = $this->post('/reset-password', [
            'code' => '654321',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $resetResponse->assertRedirect('/login');

        // Check that the user can now log in with the new password
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    public function test_phone_normalization_logic(): void
    {
        $service = new DwilioService();

        $this->assertEquals('9647701234567', $service->normalizePhone('07701234567'));
        $this->assertEquals('9647701234567', $service->normalizePhone('7701234567'));
        $this->assertEquals('9647701234567', $service->normalizePhone('+964 770 123 4567'));
        $this->assertEquals('9647701234567', $service->normalizePhone('00964-770-123-4567'));
        $this->assertEquals('966501234567', $service->normalizePhone('+9660501234567'));
    }
}
