<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console Access — Bimo Aditya</title>
    
    {{-- Import Custom Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="ambient-glow"></div>

    <div class="login-card">
        
        <div class="login-header">
            <div class="login-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h1 class="login-title">Console Access</h1>
            <p class="login-subtitle">System administration interface.</p>
        </div>

        {{-- Validation Alerts --}}
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->has('login'))
            <div class="alert alert-danger" style="margin-bottom: 20px;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ $errors->first('login') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            {{-- Username --}}
            <div style="margin-bottom: 20px;">
                <label for="username" class="form-label">Username</label>
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        placeholder="root" 
                        class="form-input"
                        required
                        autocomplete="username"
                    >
                </div>
                @error('username')
                    <p style="color: var(--accent-red); font-size: 0.72rem; margin-top: 4px; font-family: var(--font-mono);">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div style="margin-bottom: 12px;">
                <label for="password" class="form-label">Password</label>
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        class="form-input"
                        required
                        autocomplete="current-password"
                    >
                </div>
                @error('password')
                    <p style="color: var(--accent-red); font-size: 0.72rem; margin-top: 4px; font-family: var(--font-mono);">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-authenticate">
                <span>Authenticate</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </form>

        <div class="login-footer-links">
            <a href="/" class="return-link">← Return to Portfolio</a>
            <span class="footnote">Accessed via settings icon on main site.</span>
        </div>

    </div>

</body>
</html>
