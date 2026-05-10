<x-app-layout>
    <x-slot name="title">Edit Subscription</x-slot>

    <style>
        .end-date-preview {
            background: rgba(192,57,43,.08);
            border: 1px solid rgba(192,57,43,.2);
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 16px;
            font-size: 14px;
            color: var(--white);
        }
        .end-date-preview span { color: var(--red); font-weight: 500; }
    </style>

    <div class="page-header">
        <div>
            <h1>Edit Subscription</h1>
            <p>Update subscription for {{ $subscription->member->name }}</p>
        </div>
        <a href="{{ route('subscriptions.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to subscriptions
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('subscriptions.update', $subscription) }}">
            @csrf
            @method('PUT')

            <div class="form-grid-2">

                <div class="field full">
                    <label for="member_id">Member <span style="color:var(--red)">*</span></label>
                    <select id="member_id" name="member_id" required>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}"
                                {{ old('member_id', $subscription->member_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->name }} — {{ $member->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('member_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="membership_plan_id">Membership plan <span style="color:var(--red)">*</span></label>
                    <select id="membership_plan_id" name="membership_plan_id" required onchange="updateEndDate()">
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}"
                                    data-days="{{ $plan->duration_days }}"
                                {{ old('membership_plan_id', $subscription->membership_plan_id) == $plan->id ? 'selected' : '' }}>
                                {{ $plan->name }} — {{ $plan->duration_days }} days
                            </option>
                        @endforeach
                    </select>
                    @error('membership_plan_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="start_date">Start date <span style="color:var(--red)">*</span></label>
                    <input type="date" id="start_date" name="start_date"
                           value="{{ old('start_date', $subscription->start_date->format('Y-m-d')) }}"
                           required onchange="updateEndDate()">
                    @error('start_date')<span class="field-error">{{ $message }}</span>@enderror

                    <div class="end-date-preview" id="end-date-preview">
                        Subscription will end on <span id="computed-end">{{ $subscription->end_date->format('d F Y') }}</span>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save changes
                </button>
                <a href="{{ route('subscriptions.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

    <script>
        function updateEndDate() {
            const sel      = document.getElementById('membership_plan_id');
            const opt      = sel.options[sel.selectedIndex];
            const startVal = document.getElementById('start_date').value;
            if (!startVal) return;
            const days = parseInt(opt.dataset.days);
            const end  = new Date(startVal);
            end.setDate(end.getDate() + days);
            document.getElementById('computed-end').textContent =
                end.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
        }
    </script>

</x-app-layout>