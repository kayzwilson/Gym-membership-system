<x-app-layout>
    <x-slot name="title">{{ $member->name }}</x-slot>

    <style>
        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            align-items: start;
        }

        .profile-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px 24px;
            text-align: center;
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(192,57,43,0.12);
            border: 2px solid rgba(192,57,43,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--red);
            margin: 0 auto 16px;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 500;
            color: var(--white);
            margin-bottom: 4px;
        }

        .profile-email {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 20px;
        }

        .profile-divider {
            height: 1px;
            background: var(--border);
            margin: 16px 0;
        }

        .profile-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 13px;
        }

        .profile-detail-label { color: var(--muted); }
        .profile-detail-value { color: var(--white); font-weight: 500; }

        .profile-actions {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .profile-actions .btn-red,
        .profile-actions .btn-ghost {
            flex: 1;
            justify-content: center;
            font-size: 13px;
            padding: 9px 12px;
        }

        .sub-card {
            background: var(--black);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: border-color .2s;
        }

        .sub-card:hover { border-color: #2a2a2a; }

        .sub-plan-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--white);
            margin-bottom: 3px;
        }

        .sub-dates {
            font-size: 12px;
            color: var(--muted);
        }

        .sub-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
        }

        .sub-amount {
            font-size: 14px;
            font-weight: 500;
            color: var(--white);
        }
    </style>

    {{-- Header --}}
    <div class="page-header">
        <div>
            <h1>Member Profile</h1>
            <p>Viewing details for {{ $member->name }}</p>
        </div>
        <a href="{{ route('members.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to members
        </a>
    </div>

    <div class="profile-grid">

        {{-- Left: profile card --}}
        <div class="profile-card">
            <div class="profile-avatar">
                {{ strtoupper(substr($member->name, 0, 2)) }}
            </div>
            <p class="profile-name">{{ $member->name }}</p>
            <p class="profile-email">{{ $member->email }}</p>

            @php $hasActive = $member->subscriptions->where('end_date', '>=', now())->count(); @endphp
            @if($hasActive)
                <span class="badge badge-green"><span class="badge-dot"></span>Active member</span>
            @else
                <span class="badge badge-red"><span class="badge-dot"></span>No active plan</span>
            @endif

            <div class="profile-divider"></div>

            <div class="profile-detail-row">
                <span class="profile-detail-label">Phone</span>
                <span class="profile-detail-value">{{ $member->phone ?? '—' }}</span>
            </div>
            <div class="profile-detail-row">
                <span class="profile-detail-label">Gender</span>
                <span class="profile-detail-value">{{ $member->gender ?? '—' }}</span>
            </div>
            <div class="profile-detail-row">
                <span class="profile-detail-label">Date of birth</span>
                <span class="profile-detail-value">
                    {{ $member->dob ? $member->dob->format('d M Y') : '—' }}
                </span>
            </div>
            <div class="profile-detail-row">
                <span class="profile-detail-label">Member since</span>
                <span class="profile-detail-value">{{ $member->created_at->format('d M Y') }}</span>
            </div>

            <div class="profile-divider"></div>

            <div class="profile-actions">
                <a href="{{ route('members.edit', $member) }}" class="btn-red">Edit</a>
                <form method="POST" action="{{ route('members.destroy', $member) }}"
                      onsubmit="return confirm('Remove this member?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-ghost" style="color:#e05a4a; border-color:rgba(192,57,43,0.3);">Delete</button>
                </form>
            </div>
        </div>

        {{-- Right: subscriptions --}}
        <div>
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                <p style="font-size:15px; font-weight:500; color:var(--white);">
                    Subscriptions
                    <span style="font-size:13px; color:var(--muted); font-weight:400; margin-left:6px;">
                        ({{ $member->subscriptions->count() }})
                    </span>
                </p>
                <a href="{{ route('subscriptions.create') }}" class="btn-red" style="font-size:13px; padding:8px 14px;">
                    + Assign plan
                </a>
            </div>

            @if($member->subscriptions->isEmpty())
                <div class="card" style="text-align:center; padding:40px;">
                    <p style="color:var(--muted); font-size:14px; margin-bottom:16px;">No subscriptions yet.</p>
                    <a href="{{ route('subscriptions.create') }}" class="btn-red">Assign a plan</a>
                </div>
            @else
                <div style="display:flex; flex-direction:column; gap:10px;">
                    @foreach($member->subscriptions->sortByDesc('start_date') as $sub)
                        <div class="sub-card">
                            <div>
                                <p class="sub-plan-name">{{ $sub->plan->name ?? 'Unknown plan' }}</p>
                                <p class="sub-dates">
                                    {{ $sub->start_date->format('d M Y') }} → {{ $sub->end_date->format('d M Y') }}
                                </p>
                            </div>
                            <div class="sub-right">
                                @if($sub->status === 'Active')
                                    <span class="badge badge-green"><span class="badge-dot"></span>Active</span>
                                @else
                                    <span class="badge badge-red"><span class="badge-dot"></span>Expired</span>
                                @endif
                                @if($sub->payment)
                                    <span class="sub-amount">UGX {{ number_format($sub->payment->amount) }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</x-app-layout>