<x-app-layout>
    <x-slot name="title">Subscriptions</x-slot>

    <style>
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 7px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--soft);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            cursor: pointer;
            transition: all .2s;
        }

        .filter-btn:hover  { border-color: #333; color: var(--white); }
        .filter-btn.active { background: rgba(192,57,43,.12); border-color: rgba(192,57,43,.3); color: var(--white); }

        .member-cell { display: flex; align-items: center; gap: 10px; }

        .mini-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: rgba(192,57,43,.1);
            border: 1px solid rgba(192,57,43,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500; color: var(--red); flex-shrink: 0;
        }

        .cell-name  { font-size: 14px; color: var(--white); font-weight: 500; }
        .cell-sub   { font-size: 12px; color: var(--muted); }

        .progress-wrap { display: flex; align-items: center; gap: 10px; }

        .progress-bar {
            flex: 1;
            height: 4px;
            background: #2a2a2a;
            border-radius: 2px;
            overflow: hidden;
            min-width: 80px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 2px;
            background: var(--red);
            transition: width .3s;
        }

        .progress-fill.green  { background: #2ecc71; }
        .progress-fill.yellow { background: #f39c12; }
        .progress-fill.red    { background: #e05a4a; }

        .progress-pct { font-size: 12px; color: var(--muted); white-space: nowrap; }

        .action-btns { display: flex; align-items: center; gap: 8px; }

        .btn-icon {
            width: 30px; height: 30px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; text-decoration: none;
            transition: border-color .2s, background .2s;
        }

        .btn-icon svg {
            width: 13px; height: 13px;
            stroke: var(--soft); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .btn-icon:hover { border-color: #333; background: rgba(255,255,255,.04); }
        .btn-icon:hover svg { stroke: var(--white); }
        .btn-icon.danger:hover { border-color: rgba(192,57,43,.4); background: rgba(192,57,43,.08); }
        .btn-icon.danger:hover svg { stroke: #e05a4a; }

        .pagination-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 16px; border-top: 1px solid var(--border);
            font-size: 13px; color: var(--muted);
        }

        .page-links { display: flex; gap: 4px; }

        .page-links a, .page-links span {
            padding: 5px 10px; border-radius: 6px;
            border: 1px solid var(--border); color: var(--soft);
            text-decoration: none; font-size: 13px; transition: all .2s;
        }

        .page-links a:hover { border-color: #333; color: var(--white); }
        .page-links span.active-page {
            background: rgba(192,57,43,.12); border-color: rgba(192,57,43,.3); color: var(--white);
        }

        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-icon {
            width: 56px; height: 56px;
            background: rgba(192,57,43,.08); border: 1px solid rgba(192,57,43,.15);
            border-radius: 14px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .empty-icon svg { width: 24px; height: 24px; stroke: var(--red); fill: none; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
        .empty-state h3 { font-size: 16px; font-weight: 500; color: var(--white); margin-bottom: 6px; }
        .empty-state p  { font-size: 14px; color: var(--muted); margin-bottom: 20px; }
    </style>

    <div class="page-header">
        <div>
            <h1>Subscriptions</h1>
            <p>{{ $subscriptions->total() }} total subscription{{ $subscriptions->total() === 1 ? '' : 's' }}</p>
        </div>
        <a href="{{ route('subscriptions.create') }}" class="btn-red">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Assign plan
        </a>
    </div>

    {{-- Filter buttons --}}
    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterSubs('all', this)">All</button>
        <button class="filter-btn" onclick="filterSubs('active', this)">Active</button>
        <button class="filter-btn" onclick="filterSubs('expired', this)">Expired</button>
        <button class="filter-btn" onclick="filterSubs('expiring', this)">Expiring soon</button>
    </div>

    <div class="table-wrap">
        @if($subscriptions->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <h3>No subscriptions yet</h3>
                <p>Assign a membership plan to a member to get started.</p>
                <a href="{{ route('subscriptions.create') }}" class="btn-red">Assign first plan</a>
            </div>
        @else
            <table id="subs-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Plan</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $sub)
                        @php
                            $total   = $sub->start_date->diffInDays($sub->end_date);
                            $elapsed = $sub->start_date->diffInDays(now());
                            $pct     = $total > 0 ? min(100, round(($elapsed / $total) * 100)) : 100;
                            $daysLeft = now()->diffInDays($sub->end_date, false);
                            $isActive  = $sub->status === 'Active';
                            $expiring  = $isActive && $daysLeft <= 7;
                            $barClass  = $isActive ? ($expiring ? 'yellow' : 'green') : 'red';
                            $dataStatus = $isActive ? ($expiring ? 'expiring' : 'active') : 'expired';
                        @endphp
                        <tr data-status="{{ $dataStatus }}">
                            <td>
                                <div class="member-cell">
                                    <div class="mini-avatar">
                                        {{ strtoupper(substr($sub->member->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="cell-name">{{ $sub->member->name }}</p>
                                        <p class="cell-sub">{{ $sub->member->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--white); font-weight: 500;">
                                {{ $sub->plan->name ?? '—' }}
                                <p style="font-size:12px; color:var(--muted); font-weight:400;">
                                    {{ $sub->plan->duration_days ?? '' }} days
                                </p>
                            </td>
                            <td>{{ $sub->start_date->format('d M Y') }}</td>
                            <td>{{ $sub->end_date->format('d M Y') }}</td>
                            <td>
                                <div class="progress-wrap">
                                    <div class="progress-bar">
                                        <div class="progress-fill {{ $barClass }}" style="width:{{ $pct }}%"></div>
                                    </div>
                                    <span class="progress-pct">
                                        @if($isActive)
                                            {{ max(0, $daysLeft) }}d left
                                        @else
                                            Done
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td>
                                @if($expiring)
                                    <span class="badge badge-yellow"><span class="badge-dot"></span>Expiring</span>
                                @elseif($isActive)
                                    <span class="badge badge-green"><span class="badge-dot"></span>Active</span>
                                @else
                                    <span class="badge badge-red"><span class="badge-dot"></span>Expired</span>
                                @endif
                            </td>
                            <td>
                                @if($sub->payment)
                                    <span style="color: #2ecc71; font-size:13px; font-weight:500;">
                                        UGX {{ number_format($sub->payment->amount) }}
                                    </span>
                                    <p style="font-size:11px; color:var(--muted);">{{ $sub->payment->method }}</p>
                                @else
                                    <a href="{{ route('payments.create') }}?subscription_id={{ $sub->id }}"
                                       style="font-size:12px; color:var(--red); text-decoration:none;">
                                        + Record payment
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('subscriptions.edit', $sub) }}" class="btn-icon" title="Edit">
                                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('subscriptions.destroy', $sub) }}"
                                          onsubmit="return confirm('Remove this subscription?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon danger" title="Delete">
                                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($subscriptions->hasPages())
                <div class="pagination-wrap">
                    <span>Showing {{ $subscriptions->firstItem() }}–{{ $subscriptions->lastItem() }} of {{ $subscriptions->total() }}</span>
                    <div class="page-links">
                        @if($subscriptions->onFirstPage())
                            <span>← Prev</span>
                        @else
                            <a href="{{ $subscriptions->previousPageUrl() }}">← Prev</a>
                        @endif
                        @foreach($subscriptions->getUrlRange(1, $subscriptions->lastPage()) as $page => $url)
                            @if($page == $subscriptions->currentPage())
                                <span class="active-page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                        @if($subscriptions->hasMorePages())
                            <a href="{{ $subscriptions->nextPageUrl() }}">Next →</a>
                        @else
                            <span>Next →</span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>

    <script>
        function filterSubs(status, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('#subs-table tbody tr').forEach(row => {
                if (status === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === status ? '' : 'none';
                }
            });
        }
    </script>

</x-app-layout>