<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'IronPulse' }} — IronPulse</title>
    <link rel="icon" type="image/png" href="{{ asset('images/gym-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:   #0f0f0f;
            --red:     #c0392b;
            --red-dk:  #961d12;
            --card:    #141414;
            --sidebar: #111111;
            --border:  #1e1e1e;
            --muted:   #555;
            --soft:    #888;
            --white:   #ffffff;
        }

        html, body { height: 100%; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            letter-spacing: 1px;
            color: var(--white);
            text-decoration: none;
            display: block;
            line-height: 1;
        }

        .logo-text span { color: var(--red); }

        .logo-tagline {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 3px;
            display: block;
        }

        /* ── NAV MENU ── */
        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0 8px;
            margin: 16px 0 6px;
        }

        .nav-section-label:first-child { margin-top: 4px; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--soft);
            font-size: 14px;
            transition: background .15s, color .15s;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.04);
            color: var(--white);
        }

        .nav-item.active {
            background: rgba(192,57,43,0.12);
            color: var(--white);
            border: 1px solid rgba(192,57,43,0.2);
        }

        .nav-item.active .nav-icon { color: var(--red); }

        .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ── SIDEBAR FOOTER ── */
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        .user-block {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(192,57,43,0.15);
            border: 1px solid rgba(192,57,43,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 500;
            color: var(--red);
            flex-shrink: 0;
        }

        .user-info { overflow: hidden; }

        .user-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: var(--muted);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 8px;
            background: transparent;
            border: none;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            transition: background .15s, color .15s;
        }

        .logout-btn:hover {
            background: rgba(192,57,43,0.08);
            color: #e05a4a;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOP BAR ── */
        .topbar {
            height: 60px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            background: rgba(15,15,15,0.8);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--white);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-date {
            font-size: 13px;
            color: var(--muted);
        }

        /* ── PAGE BODY ── */
        .page-body {
            padding: 32px;
            flex: 1;
        }

        /* ── SHARED COMPONENTS ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            letter-spacing: 1px;
            line-height: 1;
            color: var(--white);
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            margin-top: 4px;
        }

        .btn-red {
            background: var(--red);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s;
        }

        .btn-red:hover { background: var(--red-dk); }

        .btn-ghost {
            background: transparent;
            color: var(--soft);
            border: 1px solid var(--border);
            padding: 10px 20px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: border-color .2s, color .2s;
        }

        .btn-ghost:hover { border-color: #333; color: var(--white); }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
        }

        /* ── TABLE ── */
        .table-wrap {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            background: #111;
        }

        tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--soft);
            border-bottom: 1px solid var(--border);
        }

        tbody tr:last-child td { border-bottom: none; }

        tbody tr:hover td { background: rgba(255,255,255,0.02); color: var(--white); }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-green {
            background: rgba(39,174,96,0.12);
            color: #2ecc71;
            border: 1px solid rgba(39,174,96,0.2);
        }

        .badge-red {
            background: rgba(192,57,43,0.12);
            color: #e05a4a;
            border: 1px solid rgba(192,57,43,0.2);
        }

        .badge-yellow {
            background: rgba(241,196,15,0.12);
            color: #f39c12;
            border: 1px solid rgba(241,196,15,0.2);
        }

        .badge-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        /* ── FORM STYLES (shared across create/edit pages) ── */
        .form-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px;
            max-width: 640px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .field.full { grid-column: 1 / -1; }

        .field label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .field input,
        .field select,
        .field textarea {
            background: var(--black);
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
            width: 100%;
        }

        .field select option { background: #1a1a1a; }

        .field input:focus,
        .field select:focus,
        .field textarea:focus { border-color: var(--red); }

        .field input::placeholder,
        .field textarea::placeholder { color: #3a3a3a; }

        .field-error {
            font-size: 12px;
            color: #e05a4a;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        /* ── ALERT ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(39,174,96,0.08);
            border: 1px solid rgba(39,174,96,0.2);
            color: #2ecc71;
        }

        .alert-error {
            background: rgba(192,57,43,0.08);
            border: 1px solid rgba(192,57,43,0.2);
            color: #e05a4a;
        }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

       <div class="sidebar-logo">
          <a href="{{ route('dashboard') }}" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
              <img src="{{ asset('images/gym-logo.png') }}" alt="IronPulse" style="width:36px; height:36px; border-radius:8px; object-fit:cover;">
             <div>
               <span class="logo-text">Iron<span>Pulse</span></span>
               <span class="logo-tagline" style="display:block;">Gym Management</span>
             </div>
          </a>
       </div>

        <nav class="sidebar-nav">

            <p class="nav-section-label">Overview</p>

            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                Dashboard
            </a>

            <p class="nav-section-label">Management</p>

            <a href="{{ route('members.index') }}"
               class="nav-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Members
            </a>

            <a href="{{ route('plans.index') }}"
               class="nav-item {{ request()->routeIs('plans.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                Plans
            </a>

            <a href="{{ route('subscriptions.index') }}"
               class="nav-item {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Subscriptions
            </a>

            <a href="{{ route('payments.index') }}"
               class="nav-item {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
                Payments
            </a>

        </nav>

        <div class="sidebar-footer">
            <div class="user-block">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="user-info">
                    <p class="user-name">{{ auth()->user()->name }}</p>
                    <p class="user-role">Administrator</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Sign out
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN --}}
    <div class="main-content">

        <header class="topbar">
            <span class="topbar-title">{{ $title ?? 'Dashboard' }}</span>
            <div class="topbar-right">
                <span class="topbar-date" id="topbar-date"></span>
            </div>
        </header>

        <main class="page-body">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

        </main>
    </div>

    <script>
        const el = document.getElementById('topbar-date');
        if (el) {
            const now = new Date();
            el.textContent = now.toLocaleDateString('en-US', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
        }
    </script>

</body>
</html>