<!DOCTYPE html>
<html lang="id" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console Access — Orbis Portfolio Administration</title>
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Condiment&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #010828;
            color: #94a3b8;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        }
        .liquid-glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .anton-text {
            font-family: 'Anton', sans-serif;
            text-transform: uppercase;
        }
        .cursive-text {
            font-family: 'Condiment', cursive;
            color: #6FFF00;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-surface p-4">

    {{-- Background Video / Ambient Overlay --}}
    <div class="fixed inset-0 z-0 pointer-events-none">
        <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-20 filter grayscale">
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_045634_e1c98c76-1265-4f5c-882a-4276f2080894.mp4" type="video/mp4" />
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-void-black/80 via-void-black/90 to-void-black"></div>
    </div>

    {{-- Ambient Neon Glow --}}
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-accent-neon/10 rounded-full blur-[140px] pointer-events-none z-0"></div>

    {{-- Login Card Container --}}
    <div class="relative z-10 w-full max-w-md liquid-glass rounded-3xl p-8 sm:p-10 border border-white/10 shadow-2xl space-y-8">
        
        {{-- Header --}}
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white/5 border border-white/10 text-accent-neon mb-2 shadow-inner">
                <span class="material-symbols-outlined text-3xl">shield_person</span>
            </div>
            <h1 class="anton-text text-4xl text-white tracking-wide">
                Console <span class="cursive-text text-3xl normal-case">Access</span>
            </h1>
            <p class="text-xs font-mono uppercase text-white/50 tracking-widest">
                Protected Admin Console System
            </p>
        </div>

        {{-- Session Alerts --}}
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-accent-neon/10 border border-accent-neon/30 text-accent-neon text-xs font-mono text-center flex items-center justify-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->has('login'))
            <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono text-center flex items-center justify-center gap-2">
                <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0"></i>
                <span>{{ $errors->first('login') }}</span>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Username --}}
            <div class="space-y-2">
                <label for="username" class="block text-[10px] font-mono uppercase tracking-widest text-white/60">
                    Username Identifier
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </span>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        placeholder="admin" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl pl-11 pr-4 py-3.5 text-xs font-mono text-white placeholder-white/20 focus:outline-none focus:border-accent-neon/60 focus:ring-1 focus:ring-accent-neon/40 transition-all"
                        required
                        autocomplete="username"
                    />
                </div>
                @error('username')
                    <p class="text-[10px] font-mono text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="space-y-2">
                <label for="password" class="block text-[10px] font-mono uppercase tracking-widest text-white/60">
                    Security Passcode
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </span>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl pl-11 pr-4 py-3.5 text-xs font-mono text-white placeholder-white/20 focus:outline-none focus:border-accent-neon/60 focus:ring-1 focus:ring-accent-neon/40 transition-all"
                        required
                        autocomplete="current-password"
                    />
                </div>
                @error('password')
                    <p class="text-[10px] font-mono text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button 
                type="submit" 
                class="w-full py-4 bg-accent-neon text-void-black anton-text text-lg rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 shadow-lg shadow-accent-neon/20 flex items-center justify-center gap-2 group cursor-pointer">
                <span>AUTHENTICATE</span>
                <i data-lucide="arrow-right" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"></i>
            </button>
        </form>

        {{-- Footer --}}
        <div class="pt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-[10px] font-mono text-white/40 gap-2">
            <a href="/" class="hover:text-accent-neon transition-colors flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-3 h-3"></i>
                <span>Back to Portfolio</span>
            </a>
            <span class="uppercase tracking-widest text-[9px] text-white/30">Orbis Console v2.0</span>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>
</body>
</html>
