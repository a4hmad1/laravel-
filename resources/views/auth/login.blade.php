@extends('layouts.app', ['title' => 'Sign In'])

@section('content')
<div class="max-w-md mx-auto w-full">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-3 text-wa-teal border border-emerald-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-sm text-slate-500 mt-1">Sign in with your WhatsApp number or email</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf

            <!-- Phone or Email Field -->
            <div>
                <label for="login" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                    WhatsApp Phone Number or Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="login" 
                        id="login" 
                        value="{{ old('login') }}" 
                        placeholder="e.g. 07701234567 or email@domain.com" 
                        required 
                        autofocus
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
                <p class="text-[11px] text-slate-500 mt-1.5">You can enter <span class="font-mono text-slate-700">07XXXXXXXXX</span> or <span class="font-mono text-slate-700">+964XXXXXXXXXX</span></p>
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Password
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-wa-teal hover:text-wa-dark hover:underline">
                        Forgot password?
                    </a>
                </div>
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
                        placeholder="Enter your password"
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-sm font-medium text-slate-900 placeholder:text-slate-400"
                    >
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    class="w-4 h-4 rounded text-wa-teal border-slate-300 focus:ring-wa-teal cursor-pointer"
                >
                <label for="remember" class="ml-2 block text-xs font-medium text-slate-600 select-none cursor-pointer">
                    Remember me on this browser
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 rounded-xl text-white font-bold text-sm bg-gradient-to-r from-wa-teal to-wa-green hover:from-wa-dark hover:to-wa-teal shadow-lg shadow-wa-teal/20 transition-all hover:scale-[1.01] active:scale-[0.99]"
            >
                Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="bg-white px-3 text-slate-500 font-medium">New to our platform?</span>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl text-slate-700 font-semibold text-sm bg-slate-50 hover:bg-slate-100 border border-slate-200 transition-colors">
                <span>Create a new account</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
