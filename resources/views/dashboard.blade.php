@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="max-w-4xl mx-auto w-full space-y-6">
    
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-wa-dark via-wa-teal to-emerald-600 rounded-3xl p-8 text-white shadow-xl shadow-wa-teal/15 relative overflow-hidden">
        <div class="absolute right-0 top-0 translate-x-8 -translate-y-8 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-white text-xs font-semibold mb-3 backdrop-blur-xs">
                    <span class="w-2 h-2 rounded-full bg-wa-green animate-pulse"></span>
                    Account Active & Verified
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight">Welcome, {{ $user->name }}!</h1>
                <p class="text-emerald-100 text-sm mt-1">You are securely signed in via WhatsApp OTP Authentication.</p>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-slate-800 font-bold text-sm hover:bg-slate-100 transition-all shadow-md shadow-black/10">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- User Information Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md shadow-slate-200/40 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-wa-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Information
                </h2>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <svg class="w-3.5 h-3.5 mr-1 fill-current text-wa-green" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Verified
                </span>
            </div>

            <div class="space-y-4 text-sm">
                <div>
                    <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Name</span>
                    <span class="font-semibold text-slate-800 text-base">{{ $user->name }}</span>
                </div>

                <div>
                    <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-0.5">WhatsApp Number</span>
                    <div class="flex items-center gap-2">
                        <span class="font-mono font-bold text-slate-900 text-base">+{{ $user->phone }}</span>
                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                            <svg class="w-3 h-3 fill-current text-wa-green" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.288.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824zM12.012 2c-5.518 0-9.99 4.47-9.99 9.988 0 1.761.459 3.479 1.331 4.992L2 22l5.163-1.332a9.98 9.98 0 004.849 1.246h.004c5.517 0 9.988-4.471 9.988-9.989 0-5.52-4.471-9.989-9.992-9.989z"/>
                            </svg>
                            WhatsApp Verified
                        </span>
                    </div>
                </div>

                <div>
                    <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Email Address</span>
                    <span class="text-slate-800">{{ $user->email ?? 'Not provided' }}</span>
                </div>

                <div>
                    <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-0.5">Phone Verified At</span>
                    <span class="text-slate-700 font-mono text-xs">
                        {{ $user->phone_verified_at ? $user->phone_verified_at->format('M d, Y - h:i A') : 'Unverified' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Dwilio Gateway Status Card -->
        @php
            $dwilio = app(App\Services\DwilioService::class);
            $balanceInfo = $dwilio->getBalance();
        @endphp

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md shadow-slate-200/40 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-wa-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Dwilio WhatsApp Gateway
                </h2>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                    Live API
                </span>
            </div>

            @if ($balanceInfo['success'] ?? false)
                @php $data = $balanceInfo['data'] ?? []; @endphp
                <div class="space-y-4 text-sm">
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-200/60">
                        <div>
                            <span class="text-xs text-slate-500 font-medium block">Project Name</span>
                            <span class="font-bold text-slate-900 capitalize">{{ $data['name'] ?? 'Active' }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-slate-500 font-medium block">Wallet Balance</span>
                            <span class="font-extrabold text-wa-teal font-mono text-base">
                                {{ number_format($data['balance'] ?? 0) }} {{ $data['currency'] ?? 'IQD' }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">WhatsApp Channel Quota</span>
                        @foreach ($data['allowances'] ?? [] as $channel)
                            @if (($channel['channel'] ?? '') === 'whatsapp')
                                <div class="p-3 bg-emerald-50/50 rounded-xl border border-emerald-100 space-y-2">
                                    <div class="flex justify-between text-xs font-medium text-slate-700">
                                        <span>Used: <strong class="text-slate-900 font-mono">{{ $channel['usedCount'] ?? 0 }}</strong> msgs</span>
                                        <span>Quota: <strong class="text-slate-900 font-mono">{{ $channel['monthlyQuota'] ?? 0 }}</strong> msgs</span>
                                    </div>
                                    <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
                                        @php
                                            $used = $channel['usedCount'] ?? 0;
                                            $quota = max($channel['monthlyQuota'] ?? 1, 1);
                                            $pct = min(100, round(($used / $quota) * 100));
                                        @endphp
                                        <div class="bg-wa-teal h-full rounded-full transition-all" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-[11px] text-slate-500">
                                        <span>Rate: {{ $channel['rate'] ?? 25 }} IQD / OTP</span>
                                        <span>Resets: {{ \Carbon\Carbon::parse($channel['resetsAt'] ?? now())->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-4 bg-amber-50 rounded-2xl border border-amber-200 text-amber-800 text-xs">
                    <p class="font-bold">Could not fetch live balance:</p>
                    <p class="mt-1 font-mono text-[11px]">{{ $balanceInfo['error'] ?? 'Network unreachable' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
