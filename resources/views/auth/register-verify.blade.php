@extends('layouts.app', ['title' => 'Verify WhatsApp OTP'])

@section('content')
<div class="max-w-md mx-auto w-full">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200/80 p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-wa-green border border-emerald-100 shadow-sm shadow-emerald-500/10">
                <svg class="w-9 h-9 fill-current" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.288.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12.012 2c-5.518 0-9.99 4.47-9.99 9.988 0 1.761.459 3.479 1.331 4.992L2 22l5.163-1.332a9.98 9.98 0 004.849 1.246h.004c5.517 0 9.988-4.471 9.988-9.989 0-5.52-4.471-9.989-9.992-9.992z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Check Your WhatsApp</h1>
            <p class="text-sm text-slate-500 mt-1">
                We sent a 6-digit verification code to
            </p>
            <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100 font-mono text-sm font-bold text-slate-800 border border-slate-200">
                <span class="w-2 h-2 rounded-full bg-wa-green"></span>
                +{{ $phone }}
            </div>
        </div>

        <!-- Verification Form -->
        <form method="POST" action="{{ route('register.verify.submit') }}" class="space-y-6">
            @csrf

            <!-- OTP Input -->
            <div>
                <label for="code" class="block text-center text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                    Enter 6-Digit Code
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
                    class="w-full text-center text-3xl tracking-[0.5em] font-mono font-bold py-4 px-4 rounded-2xl border-2 border-slate-300 focus:border-wa-teal focus:ring-4 focus:ring-wa-teal/15 outline-none transition-all text-slate-900 bg-slate-50/50"
                >
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full py-3.5 px-4 rounded-xl text-white font-bold text-sm bg-gradient-to-r from-wa-teal to-wa-green hover:from-wa-dark hover:to-wa-teal shadow-lg shadow-wa-teal/20 transition-all hover:scale-[1.01] active:scale-[0.99]"
            >
                Verify & Activate Account
            </button>
        </form>

        <!-- Resend OTP and Change Number -->
        <div class="mt-6 pt-6 border-t border-slate-200 flex flex-col items-center gap-3 text-xs">
            <form method="POST" action="{{ route('register.resend') }}" id="resendForm">
                @csrf
                <button 
                    type="submit" 
                    id="resendBtn" 
                    class="text-wa-teal hover:text-wa-dark font-bold hover:underline disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Resend WhatsApp Code
                </button>
                <span id="countdown" class="text-slate-400 font-mono ml-1 hidden"></span>
            </form>

            <a href="{{ route('register') }}" class="text-slate-500 hover:text-slate-800 transition-colors">
                &larr; Entered wrong phone number? Change it
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Cooldown countdown for resend button
    (function() {
        const btn = document.getElementById('resendBtn');
        const countdown = document.getElementById('countdown');
        let timeLeft = 45;

        function startTimer() {
            btn.disabled = true;
            countdown.classList.remove('hidden');
            
            const timer = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    btn.disabled = false;
                    countdown.classList.add('hidden');
                    btn.innerText = 'Resend WhatsApp Code';
                } else {
                    countdown.innerText = `(${timeLeft}s)`;
                    timeLeft--;
                }
            }, 1000);
        }

        startTimer();
    })();
</script>
@endpush
@endsection
