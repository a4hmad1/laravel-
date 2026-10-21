@extends('layouts.app', ['title' => 'Reset Password - WhatsApp OTP'])

@section('content')
<div class="max-w-md mx-auto w-full">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-wa-teal border border-emerald-100">
                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Set New Password</h1>
            <p class="text-sm text-slate-500 mt-1">
                Enter the code sent to your WhatsApp
            </p>
            <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100 font-mono text-sm font-bold text-slate-800 border border-slate-200">
                <span class="w-2 h-2 rounded-full bg-wa-green"></span>
                +{{ $phone }}
            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <!-- OTP Input -->
            <div>
                <label for="code" class="block text-center text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                    6-Digit Verification Code
                </label>
                <input 
                    type="text" 
                    name="code" 
                    id="code" 
                    maxlength="6" 
                    pattern="[0-9]*" 
                    inputmode="numeric" 
                    autocomplete="one-time-code"
                    placeholder="••••••" 
                    required 
                    autofocus
                    class="w-full text-center text-3xl tracking-[0.5em] font-mono font-bold py-3.5 px-4 rounded-2xl border-2 border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-slate-900 bg-slate-50/50"
                >
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    New Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        placeholder="At least 6 characters"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Confirm New Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required 
                        placeholder="Repeat your new password"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 rounded-xl text-white font-bold text-sm bg-gradient-to-r from-wa-teal to-wa-green hover:from-wa-dark hover:to-wa-teal shadow-lg shadow-wa-teal/20 transition-all hover:scale-[1.01] active:scale-[0.99]"
            >
                Reset Password & Log In
            </button>
        </form>

        <!-- Resend Code -->
        <div class="mt-6 pt-6 border-t border-slate-200 flex flex-col items-center gap-3 text-xs">
            <form method="POST" action="{{ route('password.resend') }}">
                @csrf
                <button type="submit" class="text-wa-teal hover:text-wa-dark font-bold hover:underline">
                    Resend WhatsApp Code
                </button>
            </form>

            <a href="{{ route('password.request') }}" class="text-slate-500 hover:text-slate-800 transition-colors">
                &larr; Use another phone number
            </a>
        </div>
    </div>
</div>
@endsection
