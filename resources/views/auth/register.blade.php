<x-guest-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — IronPulse</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="{{ asset('images/gym-logo.png') }}">
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
            padding: 40px 24px;
        }

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

        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .register-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px 36px;
        }

        /* ── LOGO ── */
       .logo-block {
             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: center;
             margin-bottom: 32px;
             text-align: center;
        }

        .logo-block img {
              display: block;
              margin: 0 auto 14px auto;
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

        .logo-image {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 14px;
}

        .divider {
            height: 1px;
            background: var(--border);
            margin: 0 0 28px;
        }

        /* ── FORM GRID ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .field-group {
            display: flex;
            flex-direction: column;
        }

        .field-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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

        input:focus { border-color: var(--red); }
        input::placeholder { color: #3a3a3a; }

        .field-error {
            font-size: 12px;
            color: #e05a4a;
            margin-top: 5px;
        }

        /* ── PASSWORD STRENGTH ── */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .strength-seg {
            height: 3px;
            flex: 1;
            background: #2a2a2a;
            border-radius: 2px;
            transition: background .3s;
        }

        .strength-label {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
            min-height: 16px;
            transition: color .3s;
        }

        /* ── TERMS ── */
        .terms-row {
            grid-column: 1 / -1;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 4px;
        }

        .terms-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--red);
            cursor: pointer;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms-text {
            font-size: 13px;
            color: var(--soft);
            line-height: 1.5;
        }

        .terms-text a {
            color: var(--red);
            text-decoration: none;
        }

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
            margin-top: 24px;
            transition: background .2s, transform .15s;
        }

        .btn-submit:hover { background: var(--red-dk); transform: translateY(-1px); }
        .btn-submit svg { transition: transform .2s; }
        .btn-submit:hover svg { transform: translateX(3px); }

        /* ── FOOTER ── */
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
        }

        .card-footer a:hover { opacity: .75; }

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

    <div class="register-wrapper">

        <a href="/" class="back-link">
            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            Back to home
        </a>

        <div class="register-card">

            <div class="logo-block">
              <img src="{{ asset('images/gym-logo.png') }}" 
                alt="IronPulse"
                class="logo-image">

               <span class="logo-name">
                    Iron<span>Pulse</span>
               </span>

                <span class="logo-sub">
                  Admin Portal
                  </span>
           </div>
            <div class="divider"></div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-grid">

                    {{-- Name --}}
                    <div class="field-group full">
                        <label for="name">Full name</label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="John Doe"
                               required
                               autofocus
                               autocomplete="name">
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="field-group full">
                        <label for="email">Email address</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="admin@ironpulse.com"
                               required
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
                               autocomplete="new-password"
                               oninput="checkStrength(this.value)">
                        <div class="strength-bar">
                            <div class="strength-seg" id="seg1"></div>
                            <div class="strength-seg" id="seg2"></div>
                            <div class="strength-seg" id="seg3"></div>
                            <div class="strength-seg" id="seg4"></div>
                        </div>
                        <p class="strength-label" id="strength-label"></p>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="field-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               placeholder="••••••••"
                               required
                               autocomplete="new-password">
                        @error('password_confirmation')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn-submit">
                    Create account
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </button>
            </form>

            <div class="card-footer">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>

        </div>
    </div>

    <script>
        function checkStrength(val) {
            const segs = [
                document.getElementById('seg1'),
                document.getElementById('seg2'),
                document.getElementById('seg3'),
                document.getElementById('seg4'),
            ];
            const label = document.getElementById('strength-label');

            let score = 0;
            if (val.length >= 8)           score++;
            if (/[A-Z]/.test(val))         score++;
            if (/[0-9]/.test(val))         score++;
            if (/[^A-Za-z0-9]/.test(val))  score++;

            const colors = ['#c0392b', '#e67e22', '#f1c40f', '#27ae60'];
            const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
            const labelColors = ['', '#c0392b', '#e67e22', '#f1c40f', '#27ae60'];

            segs.forEach((s, i) => {
                s.style.background = i < score ? colors[score - 1] : '#2a2a2a';
            });

            label.textContent  = val.length ? labels[score]      : '';
            label.style.color  = val.length ? labelColors[score] : 'var(--muted)';
        }
    </script>

</body>
</html>
</x-guest-layout>