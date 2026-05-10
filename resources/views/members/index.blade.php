<x-app-layout>
    <x-slot name="title">Members</x-slot>

    <style>
        .search-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .search-input-wrap {
            position: relative;
            flex: 1;
            max-width: 320px;
        }

        .search-input-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            stroke: var(--muted);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 14px 9px 36px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
        }

        .search-input:focus { border-color: var(--red); }
        .search-input::placeholder { color: var(--muted); }

        .member-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(192,57,43,0.1);
            border: 1px solid rgba(192,57,43,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            color: var(--red);
            flex-shrink: 0;
        }

        .member-name { font-size: 14px; color: var(--white); font-weight: 500; }
        .member-email { font-size: 12px; color: var(--muted); }

        .action-btns {
            display: flex;
            align-items: center;
            gap: 8px;
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

        .btn-icon:hover { border-color: #333; background: rgba(255,255,255,0.04); }
        .btn-icon:hover svg { stroke: var(--white); }

        .btn-icon.danger:hover { border-color: rgba(192,57,43,0.4); background: rgba(192,57,43,0.08); }
        .btn-icon.danger:hover svg { stroke: #e05a4a; }

        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-top: 1px solid var(--border);
            font-size: 13px;
            color: var(--muted);
        }

        .pagination-wrap .page-links {
            display: flex;
            gap: 4px;
        }

        .pagination-wrap .page-links a,
        .pagination-wrap .page-links span {
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid var(--border);
            color: var(--soft);
            text-decoration: none;
            font-size: 13px;
            transition: border-color .2s, color .2s;
        }

        .pagination-wrap .page-links a:hover { border-color: #333; color: var(--white); }
        .pagination-wrap .page-links span.active-page {
            background: rgba(192,57,43,0.12);
            border-color: rgba(192,57,43,0.3);
            color: var(--white);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            width: 56px;
            height: 56px;
            background: rgba(192,57,43,0.08);
            border: 1px solid rgba(192,57,43,0.15);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-icon svg {
            width: 24px;
            height: 24px;
            stroke: var(--red);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .empty-state h3 { font-size: 16px; font-weight: 500; color: var(--white); margin-bottom: 6px; }
        .empty-state p  { font-size: 14px; color: var(--muted); margin-bottom: 20px; }
    </style>

    {{-- Header --}}
    <div class="page-header">
        <div>
            <h1>Members</h1>
            <p>{{ $members->total() }} registered member{{ $members->total() === 1 ? '' : 's' }}</p>
        </div>
        <a href="{{ route('members.create') }}" class="btn-red">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Add member
        </a>
    </div>

    {{-- Search --}}
    <div class="search-bar">
        <div class="search-input-wrap">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="member-search" placeholder="Search members...">
        </div>
    </div>

    {{-- Table --}}
    <div class="table-wrap">
        @if($members->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                </div>
                <h3>No members yet</h3>
                <p>Get started by registering your first gym member.</p>
                <a href="{{ route('members.create') }}" class="btn-red">Add first member</a>
            </div>
        @else
            <table id="members-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Date of birth</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        @php
                            $hasActive = $member->subscriptions()->where('end_date', '>=', now())->exists();
                        @endphp
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div class="member-avatar">
                                        {{ strtoupper(substr($member->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="member-name">{{ $member->name }}</p>
                                        <p class="member-email">{{ $member->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $member->phone ?? '—' }}</td>
                            <td>{{ $member->gender ?? '—' }}</td>
                            <td>{{ $member->dob ? \Carbon\Carbon::parse($member->dob)->format('d M Y') : '—' }}</td>
                            <td>
                                @if($hasActive)
                                    <span class="badge badge-green"><span class="badge-dot"></span>Active</span>
                                @else
                                    <span class="badge badge-red"><span class="badge-dot"></span>No plan</span>
                                @endif
                            </td>
                            <td>{{ $member->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('members.show', $member) }}" class="btn-icon" title="View">
                                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    <a href="{{ route('members.edit', $member) }}" class="btn-icon" title="Edit">
                                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('members.destroy', $member) }}"
                                          onsubmit="return confirm('Remove {{ addslashes($member->name) }}? This cannot be undone.')">
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

            {{-- Pagination --}}
            @if($members->hasPages())
                <div class="pagination-wrap">
                    <span>Showing {{ $members->firstItem() }}–{{ $members->lastItem() }} of {{ $members->total() }}</span>
                    <div class="page-links">
                        @if($members->onFirstPage())
                            <span>← Prev</span>
                        @else
                            <a href="{{ $members->previousPageUrl() }}">← Prev</a>
                        @endif

                        @foreach($members->getUrlRange(1, $members->lastPage()) as $page => $url)
                            @if($page == $members->currentPage())
                                <span class="active-page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($members->hasMorePages())
                            <a href="{{ $members->nextPageUrl() }}">Next →</a>
                        @else
                            <span>Next →</span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>

    <script>
        document.getElementById('member-search').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#members-table tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    </script>

</x-app-layout>