<x-app-layout>
    <x-slot name="title">Assign Plan</x-slot>

    <style>
        .plan-preview {
            background: var(--black);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 18px;
            margin-top: 12px;
            display: none;
        }

        .plan-preview.visible { display: block; }

        .plan-preview-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            padding: 5px 0;
        }

        .plan-preview-label { color: var(--muted); }
        .plan-preview-value { color: var(--white); font-weight: 500; }

        .end-date-preview {
            background: rgba(192,57,43,.08);
            border: 1px solid rgba(192,57,43,.2);
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 16px;
            display: none;
            font-size: 14px;
            color: var(--white);
        }

        .end-date-preview.visible { display: block; }
        .end-date-preview span { color: var(--red); font-weight: 500; }
    </style>

    <div class="page-header">
        <div>
            <h1>Assign Plan</h1>
            <p>Create a new subscription for a member</p>
        </div>
        <a href="{{ route('subscriptions.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to subscriptions
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('subscriptions.store') }}">
            @csrf

            <div class="form-grid-2">

                {{-- Member --}}
                <div class="field full">
                    <label for="member_id">Member <span style="color:var(--red)">*</span></label>
                    <select id="member_id" name="member_id" required>
                        <option value="" disabled selected>Select a member</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}"
                                {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->name }} — {{ $member->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('member_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                {{-- Plan --}}
                <div class="field full">
                    <label for="membership_plan_id">Membership plan <span style="color:var(--red)">*</span></label>
                    <select id="membership_plan_id" name="membership_plan_id" required onchange="updatePlanPreview()">
                        <option value="" disabled selected>Select a plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}"
                                    data-price="{{ $plan->price }}"
                                    data-days="{{ $plan->duration_days }}"
                                    {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->name }} — UGX {{ number_format($plan->price) }} / {{ $plan->duration_days }} days
                            </option>
                        @endforeach
                    </select>
                    @error('membership_plan_id')<span class="field-error">{{ $message }}</span>@enderror

                    {{-- Plan preview --}}
                    <div class="plan-preview" id="plan-preview">
                        <div class="plan-preview-row">
                            <span class="plan-preview-label">Price</span>
                            <span class="plan-preview-value" id="prev-price">—</span>
                        </div>
                        <div class="plan-preview-row">
                            <span class="plan-preview-label">Duration</span>
                            <span class="plan-preview-value" id="prev-days">—</span>
                        </div>
                    </div>
                </div>

                {{-- Start date --}}
                <div class="field full">
                    <label for="start_date">Start date <span style="color:var(--red)">*</span></label>
                    <input type="date" id="start_date" name="start_date"
                           value="{{ old('start_date', date('Y-m-d')) }}"
                           required
                           onchange="updateEndDate()">
                    @error('start_date')<span class="field-error">{{ $message }}</span>@enderror

                    {{-- Computed end date --}}
                    <div class="end-date-preview" id="end-date-preview">
                        Subscription will end on <span id="computed-end">—</span>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Assign plan
                </button>
                <a href="{{ route('subscriptions.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

    <script>
        function updatePlanPreview() {
            const sel     = document.getElementById('membership_plan_id');
            const opt     = sel.options[sel.selectedIndex];
            const preview = document.getElementById('plan-preview');

            if (!opt.value) { preview.classList.remove('visible'); return; }

            const price = parseInt(opt.dataset.price);
            const days  = parseInt(opt.dataset.days);

            document.getElementById('prev-price').textContent = 'UGX ' + price.toLocaleString();
            document.getElementById('prev-days').textContent  = days + ' days';
            preview.classList.add('visible');
            updateEndDate();
        }

        function updateEndDate() {
            const sel       = document.getElementById('membership_plan_id');
            const opt       = sel.options[sel.selectedIndex];
            const startVal  = document.getElementById('start_date').value;
            const endDiv    = document.getElementById('end-date-preview');
            const endSpan   = document.getElementById('computed-end');

            if (!opt.value || !startVal) { endDiv.classList.remove('visible'); return; }

            const days = parseInt(opt.dataset.days);
            const end  = new Date(startVal);
            end.setDate(end.getDate() + days);

            endSpan.textContent = end.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
            endDiv.classList.add('visible');
        }

        // Run on load if old() values exist
        document.addEventListener('DOMContentLoaded', () => {
            updatePlanPreview();
        });
    </script>

</x-app-layout>