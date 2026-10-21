@extends('layouts.app', ['title' => 'Register - WhatsApp Verification'])

@section('content')
<div class="max-w-md mx-auto w-full">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full bg-wa-green animate-pulse"></span>
                WhatsApp Verified Sign-up
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Create Your Account</h1>
            <p class="text-sm text-slate-500 mt-1">A valid WhatsApp number is required to register</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Full Name <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        placeholder="Ahmad Ali" 
                        required 
                        autofocus
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
            </div>

            <!-- WhatsApp Phone Field -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        WhatsApp Phone Number <span class="text-rose-500">*</span>
                    </label>
                    <span class="text-[11px] font-semibold text-wa-teal flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.288.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12.012 2c-5.518 0-9.99 4.47-9.99 9.988 0 1.761.459 3.479 1.331 4.992L2 22l5.163-1.332a9.98 9.98 0 004.849 1.246h.004c5.517 0 9.988-4.471 9.988-9.989 0-5.52-4.471-9.989-9.992-9.989z"/>
                        </svg>
                        WhatsApp Active
                    </span>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5 text-wa-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <input 
                        type="tel" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone') }}" 
                        placeholder="e.g. 0770 123 4567 or +964 780 123 4567" 
                        required 
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400 font-mono"
                    >
                </div>
                <p class="text-[11px] text-slate-500 mt-1">
                    An OTP will be sent to verify this number exists on WhatsApp.
                </p>
            </div>

            <!-- Optional Email Field -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Email Address <span class="text-slate-400 font-normal lowercase">(optional)</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        placeholder="you@example.com"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Password <span class="text-rose-500">*</span>
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

            <!-- Confirm Password Field -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Confirm Password <span class="text-rose-500">*</span>
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
                        placeholder="Repeat your password"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
            </div>

            <!-- Notice Box -->
            <div class="p-3.5 bg-emerald-50/70 border border-emerald-200/60 rounded-xl text-xs text-emerald-900 flex items-start gap-2.5">
                <svg class="w-4 h-4 text-wa-teal shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Clicking below will send a 6-digit WhatsApp code to verify this phone number is reachable on WhatsApp.</span>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 rounded-xl text-white font-bold text-sm bg-gradient-to-r from-wa-teal to-wa-green hover:from-wa-dark hover:to-wa-teal shadow-lg shadow-wa-teal/20 transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2"
            >
                <span>Verify on WhatsApp & Register</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-6 pt-6 border-t border-slate-200">
            <p class="text-xs text-slate-500">
                Already registered? 
                <a href="{{ route('login') }}" class="font-bold text-wa-teal hover:text-wa-dark hover:underline">
                    Sign in to your account
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
