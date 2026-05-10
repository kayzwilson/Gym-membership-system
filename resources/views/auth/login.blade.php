<x-guest-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — IronPulse</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:  #0f0f0f;
            --red:    #c0392b;
            --red-dk: #961d12;
            --card:   #141414;
            --border: #1e1e1e;
            --muted:  #555;
            --soft:   #888;
            --white:  #ffffff;
        }

        html, body { height: 100%; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Background grid */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(192,57,43,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(192,57,43,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        /* Red glow top */
        body::after {
            content: '';
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 400px;
            background: radial-gradient(ellipse, rgba(192,57,43,0.10) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── CARD ── */
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 24px;
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px 36px;
        }

        /* ── LOGO ── */
        .logo-block {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: rgba(192,57,43,0.12);
            border: 1px solid rgba(192,57,43,0.25);
            border-radius: 12px;
            margin-bottom: 14px;
        }

        .logo-mark svg {
            width: 24px;
            height: 24px;
            stroke: var(--red);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .logo-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1px;
            color: var(--white);
            display: block;
            line-height: 1;
            margin-bottom: 4px;
        }

        .logo-name span { color: var(--red); }

        .logo-sub {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* ── DIVIDER ── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 0 0 28px;
        }

        /* ── SESSION STATUS ── */
        .session-status {
            background: rgba(192,57,43,0.08);
            border: 1px solid rgba(192,57,43,0.2);
            color: #e05a4a;
            font-size: 13px;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* ── FORM ── */
        .field-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            background: var(--black);
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 11px 14px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
        }

        input:focus {
            border-color: var(--red);
        }

        input::placeholder { color: #3a3a3a; }

        /* ── FIELD ERROR ── */
        .field-error {
            font-size: 12px;
            color: #e05a4a;
            margin-top: 6px;
        }

        /* ── REMEMBER + FORGOT ROW ── */
        .form-extras {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--soft);
            cursor: pointer;
            text-transform: none;
            letter-spacing: 0;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--red);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--red);
            text-decoration: none;
            transition: opacity .2s;
        }

        .forgot-link:hover { opacity: .75; }

        /* ── SUBMIT ── */
        .btn-submit {
            width: 100%;
            background: var(--red);
            color: var(--white);
            border: none;
            padding: 13px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background .2s, transform .15s;
        }

        .btn-submit:hover {
            background: var(--red-dk);
            transform: translateY(-1px);
        }

        .btn-submit svg {
            transition: transform .2s;
        }

        .btn-submit:hover svg { transform: translateX(3px); }

        /* ── FOOTER LINK ── */
        .card-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: var(--muted);
        }

        .card-footer a {
            color: var(--red);
            text-decoration: none;
            font-weight: 500;
            transition: opacity .2s;
        }

        .card-footer a:hover { opacity: .75; }

        /* ── BACK LINK ── */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 24px;
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
            transition: color .2s;
        }

        .back-link:hover { color: var(--white); }

        .back-link svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">

        {{-- Back to home --}}
        <a href="/" class="back-link">
            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            Back to home
        </a>

        <div class="login-card">

            {{-- Logo --}}
            <div class="logo-block">
                <div class="logo-mark">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"/>
                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/>
                        <line x1="6" y1="1" x2="6" y2="4"/>
                        <line x1="10" y1="1" x2="10" y2="4"/>
                        <line x1="14" y1="1" x2="14" y2="4"/>
                    </svg>
                </div>
                <span class="logo-name">Iron<span>Pulse</span></span>
                <span class="logo-sub">Admin Portal</span>
            </div>

            <div class="divider"></div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field-group">
                    <label for="email">Email address</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="admin@ironpulse.com"
                           required
                           autofocus
                           autocomplete="username">
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field-group">
                    <label for="password">Password</label>
                    <input id="password"
                           type="password"
                           name="password"
                           placeholder="••••••••"
                           required
                           autocomplete="current-password">
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember me + Forgot password --}}
                <div class="form-extras">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">
                    Sign in
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </button>
            </form>

            {{-- Register link --}}
            <div class="card-footer">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>

        </div>
    </div>

</body>
</html>
</x-guest-layout>