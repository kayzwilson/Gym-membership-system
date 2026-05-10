<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: border-color .2s;
        }

        .stat-card:hover { border-color: #2a2a2a; }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 16px;
            height: 16px;
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .icon-red   { background: rgba(192,57,43,0.12); }
        .icon-red svg { stroke: var(--red); }
        .icon-green { background: rgba(39,174,96,0.12); }
        .icon-green svg { stroke: #2ecc71; }
        .icon-yellow { background: rgba(241,196,15,0.12); }
        .icon-yellow svg { stroke: #f39c12; }
        .icon-blue  { background: rgba(52,152,219,0.12); }
        .icon-blue svg { stroke: #3498db; }

        .stat-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 40px;
            color: var(--white);
            line-height: 1;
        }

        .stat-footer {
            font-size: 12px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-footer .up   { color: #2ecc71; }
        .stat-footer .warn { color: #f39c12; }
        .stat-footer .danger { color: #e05a4a; }

        /* ── TWO-COL LAYOUT ── */
        .dash-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
        }

        /* ── RECENT MEMBERS TABLE ── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--white);
        }

        .section-link {
            font-size: 13px;
            color: var(--red);
            text-decoration: none;
            transition: opacity .2s;
        }

        .section-link:hover { opacity: .75; }

        /* ── EXPIRY ALERTS ── */
        .alert-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .alert-item {
            background: var(--black);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: border-color .2s;
        }

        .alert-item:hover { border-color: #2a2a2a; }

        .alert-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(241,196,15,0.1);
            border: 1px solid rgba(241,196,15,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 500;
            color: #f39c12;
            flex-shrink: 0;
        }

        .alert-info { flex: 1; min-width: 0; }

        .alert-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .alert-days {
            font-size: 12px;
            color: #f39c12;
            margin-top: 1px;
        }

        .alert-days.expired { color: #e05a4a; }

        /* ── QUICK ACTIONS ── */
        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .quick-btn {
            background: var(--black);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            text-decoration: none;
            transition: border-color .2s, background .2s;
            cursor: pointer;
        }

        .quick-btn:hover {
            border-color: rgba(192,57,43,0.3);
            background: rgba(192,57,43,0.04);
        }

        .quick-btn-icon {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            background: rgba(192,57,43,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-btn-icon svg {
            width: 14px;
            height: 14px;
            stroke: var(--red);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .quick-btn-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--white);
        }

        .quick-btn-sub {
            font-size: 11px;
            color: var(--muted);
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--muted);
            font-size: 14px;
        }
    </style>

    {{-- Page header --}}
    <div class="page-header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome back, {{ auth()->user()->name }}. Here's what's happening today.</p>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total members</span>
                <div class="stat-icon icon-red">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
            <span class="stat-number">{{ $totalMembers }}</span>
            <span class="stat-footer">All registered members</span>
        </div>

        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Active subscriptions</span>
                <div class="stat-icon icon-green">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
            </div>
            <span class="stat-number">{{ $activeSubscriptions }}</span>
            <span class="stat-footer"><span class="up">●</span> Currently active plans</span>
        </div>

        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Expiring soon</span>
                <div class="stat-icon icon-yellow">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
            </div>
            <span class="stat-number">{{ $expiringSoon }}</span>
            <span class="stat-footer"><span class="warn">●</span> Within next 7 days</span>
        </div>

        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total revenue</span>
                <div class="stat-icon icon-blue">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
            </div>
            <span class="stat-number">{{ number_format($totalRevenue) }}</span>
            <span class="stat-footer">Lifetime payments recorded</span>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="quick-actions" style="margin-bottom: 28px;">
        <a href="{{ route('members.create') }}" class="quick-btn">
            <div class="quick-btn-icon">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
            <span class="quick-btn-label">Add member</span>
            <span class="quick-btn-sub">Register new gym member</span>
        </a>
        <a href="{{ route('subscriptions.create') }}" class="quick-btn">
            <div class="quick-btn-icon">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <span class="quick-btn-label">Assign plan</span>
            <span class="quick-btn-sub">Create a new subscription</span>
        </a>
        <a href="{{ route('payments.create') }}" class="quick-btn">
            <div class="quick-btn-icon">
                <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            </div>
            <span class="quick-btn-label">Record payment</span>
            <span class="quick-btn-sub">Log a new payment</span>
        </a>
        <a href="{{ route('plans.create') }}" class="quick-btn">
            <div class="quick-btn-icon">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="13" x2="12" y2="17"/><line x1="10" y1="15" x2="14" y2="15"/></svg>
            </div>
            <span class="quick-btn-label">New plan</span>
            <span class="quick-btn-sub">Create a membership plan</span>
        </a>
    </div>

    {{-- MAIN TWO-COL --}}
    <div class="dash-grid">

        {{-- Recent members table --}}
        <div>
            <div class="section-header">
                <span class="section-title">Recent members</span>
                <a href="{{ route('members.index') }}" class="section-link">View all →</a>
            </div>
            <div class="table-wrap">
                @if($recentMembers->isEmpty())
                    <div class="empty-state">No members yet. <a href="{{ route('members.create') }}" style="color: var(--red);">Add one →</a></div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMembers as $member)
                                <tr>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:10px;">
                                            <div style="width:30px;height:30px;border-radius:50%;background:rgba(192,57,43,0.1);border:1px solid rgba(192,57,43,0.2);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;color:var(--red);flex-shrink:0;">
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p style="font-size:14px;color:var(--white);font-weight:500;">{{ $member->name }}</p>
                                                <p style="font-size:12px;color:var(--muted);">{{ $member->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $member->phone ?? '—' }}</td>
                                    <td>
                                        @php $active = $member->subscriptions()->where('end_date', '>=', now())->exists(); @endphp
                                        @if($active)
                                            <span class="badge badge-green"><span class="badge-dot"></span>Active</span>
                                        @else
                                            <span class="badge badge-red"><span class="badge-dot"></span>No plan</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        {{-- Expiring soon sidebar --}}
        <div>
            <div class="section-header">
                <span class="section-title">Expiring soon</span>
                <a href="{{ route('subscriptions.index') }}" class="section-link">View all →</a>
            </div>
            <div class="alert-list">
                @forelse($expiringSoonList as $sub)
                    @php $daysLeft = now()->diffInDays($sub->end_date, false); @endphp
                    <div class="alert-item">
                        <div class="alert-avatar">
                            {{ strtoupper(substr($sub->member->name, 0, 2)) }}
                        </div>
                        <div class="alert-info">
                            <p class="alert-name">{{ $sub->member->name }}</p>
                            <p class="alert-days {{ $daysLeft <= 0 ? 'expired' : '' }}">
                                {{ $daysLeft <= 0 ? 'Expired' : $daysLeft . ' day' . ($daysLeft == 1 ? '' : 's') . ' left' }}
                            </p>
                        </div>
                        <a href="{{ route('subscriptions.index') }}" style="color:var(--muted);font-size:12px;">View →</a>
                    </div>
                @empty
                    <div class="empty-state" style="padding: 32px 16px;">
                        No subscriptions expiring soon.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</x-app-layout>