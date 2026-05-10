<x-app-layout>
    <x-slot name="title">Membership Plans</x-slot>

    <style>
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .plan-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: border-color .2s;
        }

        .plan-card:hover { border-color: #2a2a2a; }

        .plan-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .plan-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(192,57,43,0.1);
            border: 1px solid rgba(192,57,43,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .plan-icon svg {
            width: 18px;
            height: 18px;
            stroke: var(--red);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .plan-name {
            font-size: 16px;
            font-weight: 500;
            color: var(--white);
            margin-bottom: 2px;
        }

        .plan-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
        }

        .plan-divider { height: 1px; background: var(--border); }

        .plan-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .plan-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--red);
            line-height: 1;
        }

        .plan-price-sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
        }

        .plan-duration {
            text-align: right;
        }

        .plan-duration-num {
            font-size: 20px;
            font-weight: 500;
            color: var(--white);
        }

        .plan-duration-label {
            font-size: 11px;
            color: var(--muted);
        }

        .plan-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .plan-subs {
            font-size: 12px;
            color: var(--muted);
        }

        .plan-subs span {
            color: var(--white);
            font-weight: 500;
        }

        .plan-actions {
            display: flex;
            gap: 6px;
        }

        .btn-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .2s, background .2s;
        }

        .btn-icon svg {
            width: 13px;
            height: 13px;
            stroke: var(--soft);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .btn-icon:hover { border-color: #333; background: rgba(255,255,255,.04); }
        .btn-icon:hover svg { stroke: var(--white); }
        .btn-icon.danger:hover { border-color: rgba(192,57,43,.4); background: rgba(192,57,43,.08); }
        .btn-icon.danger:hover svg { stroke: #e05a4a; }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            width: 56px; height: 56px;
            background: rgba(192,57,43,.08);
            border: 1px solid rgba(192,57,43,.15);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-icon svg {
            width: 24px; height: 24px;
            stroke: var(--red); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .empty-state h3 { font-size: 16px; font-weight: 500; color: var(--white); margin-bottom: 6px; }
        .empty-state p  { font-size: 14px; color: var(--muted); margin-bottom: 20px; }
    </style>

    <div class="page-header">
        <div>
            <h1>Membership Plans</h1>
            <p>{{ $plans->count() }} plan{{ $plans->count() === 1 ? '' : 's' }} available</p>
        </div>
        <a href="{{ route('plans.create') }}" class="btn-red">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            New plan
        </a>
    </div>

    @if($plans->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <h3>No plans yet</h3>
            <p>Create your first membership plan to get started.</p>
            <a href="{{ route('plans.create') }}" class="btn-red">Create first plan</a>
        </div>
    @else
        <div class="plans-grid">
            @foreach($plans as $plan)
                <div class="plan-card">
                    <div class="plan-card-top">
                        <div>
                            <p class="plan-name">{{ $plan->name }}</p>
                            @if($plan->description)
                                <p class="plan-desc">{{ $plan->description }}</p>
                            @endif
                        </div>
                        <div class="plan-icon">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                    </div>

                    <div class="plan-divider"></div>

                    <div class="plan-meta">
                        <div>
                            <p class="plan-price">UGX {{ number_format($plan->price) }}</p>
                            <p class="plan-price-sub">per cycle</p>
                        </div>
                        <div class="plan-duration">
                            <p class="plan-duration-num">{{ $plan->duration_days }}</p>
                            <p class="plan-duration-label">days duration</p>
                        </div>
                    </div>

                    <div class="plan-footer">
                        <p class="plan-subs">
                            <span>{{ $plan->subscriptions_count }}</span>
                            {{ $plan->subscriptions_count === 1 ? 'subscriber' : 'subscribers' }}
                        </p>
                        <div class="plan-actions">
                            <a href="{{ route('plans.edit', $plan) }}" class="btn-icon" title="Edit">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('plans.destroy', $plan) }}"
                                  onsubmit="return confirm('Delete {{ addslashes($plan->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon danger" title="Delete">
                                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</x-app-layout>