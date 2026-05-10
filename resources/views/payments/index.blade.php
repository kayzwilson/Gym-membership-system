<x-app-layout>
    <x-slot name="title">Payments</x-slot>

    <style>
        .revenue-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .rev-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 24px;
        }

        .rev-label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .rev-amount {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--white);
            line-height: 1;
        }

        .rev-amount.red { color: var(--red); }

        .rev-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
        }

        .method-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
        }

        .method-cash   { background: rgba(39,174,96,.1);   color: #2ecc71; border: 1px solid rgba(39,174,96,.2);  }
        .method-mobile { background: rgba(52,152,219,.1);  color: #3498db; border: 1px solid rgba(52,152,219,.2); }
        .method-card   { background: rgba(155,89,182,.1);  color: #9b59b6; border: 1px solid rgba(155,89,182,.2); }

        .member-cell { display: flex; align-items: center; gap: 10px; }

        .mini-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: rgba(192,57,43,.1); border: 1px solid rgba(192,57,43,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 500; color: var(--red); flex-shrink: 0;
        }

        .cell-name { font-size: 14px; color: var(--white); font-weight: 500; }
        .cell-sub  { font-size: 12px; color: var(--muted); }

        .action-btns { display: flex; align-items: center; gap: 8px; }

        .btn-icon {
            width: 30px; height: 30px; border-radius: 6px;
            border: 1px solid var(--border); background: transparent;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; text-decoration: none; transition: all .2s;
        }

        .btn-icon svg {
            width: 13px; height: 13px; stroke: var(--soft); fill: none;
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
            <h1>Payments</h1>
            <p>{{ $payments->total() }} payment{{ $payments->total() === 1 ? '' : 's' }} recorded</p>
        </div>
        <a href="{{ route('payments.create') }}" class="btn-red">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Record payment
        </a>
    </div>

    {{-- Revenue summary --}}
    <div class="revenue-strip">
        <div class="rev-card">
            <p class="rev-label">Total revenue</p>
            <p class="rev-amount red">UGX {{ number_format($totalRevenue) }}</p>
            <p class="rev-sub">All time</p>
        </div>
        <div class="rev-card">
            <p class="rev-label">This month</p>
            <p class="rev-amount">UGX {{ number_format(
                \App\Models\Payment::whereMonth('payment_date', now()->month)
                    ->whereYear('payment_date', now()->year)
                    ->sum('amount')
            ) }}</p>
            <p class="rev-sub">{{ now()->format('F Y') }}</p>
        </div>
        <div class="rev-card">
            <p class="rev-label">Transactions</p>
            <p class="rev-amount">{{ $payments->total() }}</p>
            <p class="rev-sub">Total recorded payments</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-wrap">
        @if($payments->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                </div>
                <h3>No payments yet</h3>
                <p>Record the first payment once a member has been assigned a plan.</p>
                <a href="{{ route('payments.create') }}" class="btn-red">Record payment</a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Subscription period</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>
                                <div class="member-cell">
                                    <div class="mini-avatar">
                                        {{ strtoupper(substr($payment->subscription->member->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="cell-name">{{ $payment->subscription->member->name }}</p>
                                        <p class="cell-sub">{{ $payment->subscription->member->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--white); font-weight: 500;">
                                {{ $payment->subscription->plan->name ?? '—' }}
                            </td>
                            <td>
                                <span style="font-size: 15px; font-weight: 500; color: #2ecc71;">
                                    UGX {{ number_format($payment->amount) }}
                                </span>
                            </td>
                            <td>
                                @php $m = $payment->method; @endphp
                                <span class="method-badge {{ $m === 'Cash' ? 'method-cash' : ($m === 'Mobile Money' ? 'method-mobile' : 'method-card') }}">
                                    {{ $m }}
                                </span>
                            </td>
                            <td>{{ $payment->payment_date->format('d M Y') }}</td>
                            <td style="font-size: 13px; color: var(--muted);">
                                {{ $payment->subscription->start_date->format('d M Y') }}
                                →
                                {{ $payment->subscription->end_date->format('d M Y') }}
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('payments.edit', $payment) }}" class="btn-icon" title="Edit">
                                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('payments.destroy', $payment) }}"
                                          onsubmit="return confirm('Delete this payment record?')">
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

            @if($payments->hasPages())
                <div class="pagination-wrap">
                    <span>Showing {{ $payments->firstItem() }}–{{ $payments->lastItem() }} of {{ $payments->total() }}</span>
                    <div class="page-links">
                        @if($payments->onFirstPage())
                            <span>← Prev</span>
                        @else
                            <a href="{{ $payments->previousPageUrl() }}">← Prev</a>
                        @endif
                        @foreach($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                            @if($page == $payments->currentPage())
                                <span class="active-page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                        @if($payments->hasMorePages())
                            <a href="{{ $payments->nextPageUrl() }}">Next →</a>
                        @else
                            <span>Next →</span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>

</x-app-layout>