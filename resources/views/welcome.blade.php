<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IronPulse — Gym Management</title>
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

        html { scroll-behavior: smooth; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            height: 64px;
            background: rgba(15,15,15,0.92);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .nav-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            letter-spacing: 1px;
            color: var(--white);
            text-decoration: none;
        }

        .nav-logo span { color: var(--red); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: var(--soft);
            text-decoration: none;
            font-size: 14px;
            transition: color .2s;
        }

        .nav-links a:hover { color: var(--white); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--soft);
            padding: 8px 20px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, color .2s;
        }

        .btn-ghost:hover { border-color: #333; color: var(--white); }

        .btn-red {
            background: var(--red);
            border: none;
            color: var(--white);
            padding: 8px 20px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s;
        }

        .btn-red:hover { background: var(--red-dk); }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 32px 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(192,57,43,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(192,57,43,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        .hero-glow {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 300px;
            background: radial-gradient(ellipse, rgba(192,57,43,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(192,57,43,0.1);
            border: 1px solid rgba(192,57,43,0.25);
            color: #e05a4a;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 32px;
            position: relative;
            animation: fadeUp .6s ease both;
        }

        .eyebrow-dot {
            width: 6px;
            height: 6px;
            background: var(--red);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .5; transform: scale(.8); }
        }

        .hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(72px, 12vw, 120px);
            line-height: .95;
            letter-spacing: 2px;
            color: var(--white);
            margin-bottom: 8px;
            position: relative;
            animation: fadeUp .7s .1s ease both;
        }

        .hero-title .accent { color: var(--red); }

        .hero-title .outline {
            -webkit-text-stroke: 1px rgba(255,255,255,0.25);
            color: transparent;
        }

        .hero-sub {
            font-size: 16px;
            color: var(--soft);
            max-width: 420px;
            margin: 0 auto 40px;
            line-height: 1.7;
            position: relative;
            animation: fadeUp .7s .2s ease both;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            justify-content: center;
            position: relative;
            animation: fadeUp .7s .3s ease both;
        }

        .btn-hero {
            background: var(--red);
            color: var(--white);
            border: none;
            padding: 14px 36px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .15s;
        }

        .btn-hero:hover { background: var(--red-dk); transform: translateY(-1px); }

        .btn-hero svg { transition: transform .2s; }
        .btn-hero:hover svg { transform: translateX(3px); }

        .btn-hero-ghost {
            background: transparent;
            color: var(--soft);
            border: 1px solid var(--border);
            padding: 14px 36px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, color .2s;
        }

        .btn-hero-ghost:hover { border-color: #333; color: var(--white); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── STATS STRIP ── */
        .stats-strip {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .stat-item {
            padding: 36px 24px;
            text-align: center;
            border-right: 1px solid var(--border);
            animation: fadeUp .6s ease both;
        }

        .stat-item:last-child { border-right: none; }

        .stat-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--red);
            line-height: 1;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 6px;
            display: block;
        }

        /* ── FEATURES ── */
        .section {
            padding: 96px 48px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-label {
            font-size: 11px;
            color: var(--red);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 5vw, 56px);
            letter-spacing: 1px;
            line-height: 1.05;
            margin-bottom: 16px;
        }

        .section-sub {
            color: var(--soft);
            max-width: 480px;
            margin-bottom: 56px;
            font-size: 15px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .feature-card {
            background: var(--card);
            padding: 32px 28px;
            transition: background .2s;
        }

        .feature-card:hover { background: #181818; }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(192,57,43,0.12);
            border: 1px solid rgba(192,57,43,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .feature-icon svg {
            width: 20px;
            height: 20px;
            stroke: var(--red);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--white);
        }

        .feature-desc {
            font-size: 13px;
            color: var(--soft);
            line-height: 1.6;
        }

        /* ── CTA BANNER ── */
        .cta-banner {
            margin: 0 48px 96px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 64px 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-banner::before {
            content: '';
            position: absolute;
            top: -60px; left: 50%; transform: translateX(-50%);
            width: 400px;
            height: 200px;
            background: radial-gradient(ellipse, rgba(192,57,43,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-banner h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(32px, 5vw, 52px);
            letter-spacing: 1px;
            margin-bottom: 12px;
            position: relative;
        }

        .cta-banner p {
            color: var(--soft);
            font-size: 15px;
            margin-bottom: 32px;
            position: relative;
        }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 32px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .footer-logo span { color: var(--red); }

        footer p {
            font-size: 12px;
            color: var(--muted);
        }
    </style>
</head>
<body>

    {{-- NAV --}}
    <nav>
        <a href="/" class="nav-logo">Iron<span>Pulse</span></a>
        <ul class="nav-links">
            <li><a href="#features">Features</a></li>
            <li><a href="#about">About</a></li>
        </ul>
        <div class="nav-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-red">Go to dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost">Sign in</a>
                <a href="{{ route('register') }}" class="btn-red">Get started</a>
            @endauth
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-grid-bg"></div>
        <div class="hero-glow"></div>

        <div class="hero-eyebrow">
            <span class="eyebrow-dot"></span>
            Gym management platform
        </div>

        <h1 class="hero-title">
            Iron<span class="accent">Pulse</span><br>
            <span class="outline">Management</span>
        </h1>

        <p class="hero-sub">
            Track members, manage plans, monitor payments — everything your gym needs in one powerful dashboard.
        </p>

        <div class="hero-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-hero">
                    Go to dashboard
                    <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-hero">
                    Get started
                    <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn-hero-ghost">Sign in</a>
            @endauth
        </div>
    </section>

    {{-- STATS --}}
    <div class="stats-strip">
        <div class="stat-item">
            <span class="stat-number">500+</span>
            <span class="stat-label">Members tracked</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">12</span>
            <span class="stat-label">Plan types</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">98%</span>
            <span class="stat-label">Renewal rate</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">24/7</span>
            <span class="stat-label">System uptime</span>
        </div>
    </div>

    {{-- FEATURES --}}
    <section class="section" id="features">
        <p class="section-label">What we offer</p>
        <h2 class="section-title">Everything your gym needs</h2>
        <p class="section-sub">Built for gym administrators who want control, clarity, and speed.</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <p class="feature-title">Member management</p>
                <p class="feature-desc">Register, update, and manage all your gym members with full profile tracking.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <p class="feature-title">Membership plans</p>
                <p class="feature-desc">Create and manage monthly, quarterly, and annual plans with custom pricing.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                </div>
                <p class="feature-title">Payment tracking</p>
                <p class="feature-desc">Record and monitor all membership payments with method and date history.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <p class="feature-title">Live dashboard</p>
                <p class="feature-desc">Get instant stats on active members, revenue, and expiring subscriptions.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <p class="feature-title">Subscription control</p>
                <p class="feature-desc">Assign plans to members, track start and end dates, and manage renewals.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <p class="feature-title">Secure access</p>
                <p class="feature-desc">Role-based authentication ensures only authorized admins access the system.</p>
            </div>
        </div>
    </section>

    {{-- CTA BANNER --}}
    <div class="cta-banner">
        <h2>Ready to run your gym smarter?</h2>
        <p>Join IronPulse and take full control of your membership operations today.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn-hero">Go to dashboard
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-hero">Create your account
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        @endauth
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-logo">Iron<span>Pulse</span></div>
        <p>&copy; {{ date('Y') }} IronPulse. Gym Management System.</p>
    </footer>

</body>
</html>