<x-app-layout>
    <x-slot name="title">Record Payment</x-slot>

    <style>
        .sub-preview {
            background: var(--black);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 18px;
            margin-top: 12px;
            display: none;
        }

        .sub-preview.visible { display: block; }

        .sub-preview-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            padding: 5px 0;
            border-bottom: 1px solid var(--border);
        }

        .sub-preview-row:last-child { border-bottom: none; }

        .sub-preview-label { color: var(--muted); }
        .sub-preview-value { color: var(--white); font-weight: 500; }

        .method-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 0;
        }

        .method-option { display: none; }

        .method-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--black);
            cursor: pointer;
            transition: all .2s;
            text-align: center;
        }

        .method-label:hover { border-color: #333; }

        .method-option:checked + .method-label {
            border-color: var(--red);
            background: rgba(192,57,43,.08);
        }

        .method-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(192,57,43,.1);
        }

        .method-icon svg {
            width: 16px; height: 16px; stroke: var(--red); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .method-name { font-size: 13px; font-weight: 500; color: var(--white); }
    </style>

    <div class="page-header">
        <div>
            <h1>Record Payment</h1>
            <p>Log a payment for a subscription</p>
        </div>
        <a href="{{ route('payments.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to payments
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('payments.store') }}">
            @csrf

            <div class="form-grid-2">

                {{-- Subscription --}}
                <div class="field full">
                    <label for="subscription_id">Subscription <span style="color:var(--red)">*</span></label>
                    <select id="subscription_id" name="subscription_id" required onchange="updateSubPreview()">
                        <option value="" disabled selected>Select a subscription</option>
                        @foreach($subscriptions as $sub)
                            <option value="{{ $sub->id }}"
                                    data-member="{{ $sub->member->name }}"
                                    data-plan="{{ $sub->plan->name }}"
                                    data-price="{{ $sub->plan->price }}"
                                    data-start="{{ $sub->start_date->format('d M Y') }}"
                                    data-end="{{ $sub->end_date->format('d M Y') }}"
                                    data-status="{{ $sub->status }}"
                                    {{ (old('subscription_id', $preselected) == $sub->id) ? 'selected' : '' }}>
                                {{ $sub->member->name }} — {{ $sub->plan->name }}
                                ({{ $sub->start_date->format('d M Y') }} → {{ $sub->end_date->format('d M Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('subscription_id')<span class="field-error">{{ $message }}</span>@enderror

                    {{-- Subscription preview --}}
                    <div class="sub-preview" id="sub-preview">
                        <div class="sub-preview-row">
                            <span class="sub-preview-label">Member</span>
                            <span class="sub-preview-value" id="prev-member">—</span>
                        </div>
                        <div class="sub-preview-row">
                            <span class="sub-preview-label">Plan</span>
                            <span class="sub-preview-value" id="prev-plan">—</span>
                        </div>
                        <div class="sub-preview-row">
                            <span class="sub-preview-label">Period</span>
                            <span class="sub-preview-value" id="prev-period">—</span>
                        </div>
                        <div class="sub-preview-row">
                            <span class="sub-preview-label">Plan price</span>
                            <span class="sub-preview-value" id="prev-price">—</span>
                        </div>
                        <div class="sub-preview-row">
                            <span class="sub-preview-label">Status</span>
                            <span class="sub-preview-value" id="prev-status">—</span>
                        </div>
                    </div>
                </div>

                {{-- Amount --}}
                <div class="field full">
                    <label for="amount">Amount (UGX) <span style="color:var(--red)">*</span></label>
                    <input type="number" id="amount" name="amount"
                           value="{{ old('amount') }}"
                           placeholder="e.g. 150000"
                           min="0" step="500" required>
                    @error('amount')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                {{-- Payment method --}}
                <div class="field full">
                    <label>Payment method <span style="color:var(--red)">*</span></label>
                    <div class="method-grid">

                        <div>
                            <input type="radio" id="method_cash" name="method" value="Cash"
                                   class="method-option" {{ old('method') === 'Cash' ? 'checked' : '' }}>
                            <label for="method_cash" class="method-label">
                                <div class="method-icon">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                </div>
                                <span class="method-name">Cash</span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="method_mobile" name="method" value="Mobile Money"
                                   class="method-option" {{ old('method') === 'Mobile Money' ? 'checked' : '' }}>
                            <label for="method_mobile" class="method-label">
                                <div class="method-icon">
                                    <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                </div>
                                <span class="method-name">Mobile Money</span>
                            </label>
                        </div>

                        <div>
                            <input type="radio" id="method_card" name="method" value="Card"
                                   class="method-option" {{ old('method') === 'Card' ? 'checked' : '' }}>
                            <label for="method_card" class="method-label">
                                <div class="method-icon">
                                    <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                </div>
                                <span class="method-name">Card</span>
                            </label>
                        </div>

                    </div>
                    @error('method')<span class="field-error" style="margin-top:8px; display:block;">{{ $message }}</span>@enderror
                </div>

                {{-- Payment date --}}
                <div class="field full">
                    <label for="payment_date">Payment date <span style="color:var(--red)">*</span></label>
                    <input type="date" id="payment_date" name="payment_date"
                           value="{{ old('payment_date', date('Y-m-d')) }}"
                           required>
                    @error('payment_date')<span class="field-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                    Record payment
                </button>
                <a href="{{ route('payments.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

    <script>
        function updateSubPreview() {
            const sel     = document.getElementById('subscription_id');
            const opt     = sel.options[sel.selectedIndex];
            const preview = document.getElementById('sub-preview');

            if (!opt.value) { preview.classList.remove('visible'); return; }

            document.getElementById('prev-member').textContent  = opt.dataset.member;
            document.getElementById('prev-plan').textContent    = opt.dataset.plan;
            document.getElementById('prev-period').textContent  = opt.dataset.start + ' → ' + opt.dataset.end;
            document.getElementById('prev-price').textContent   = 'UGX ' + parseInt(opt.dataset.price).toLocaleString();
            document.getElementById('prev-status').textContent  = opt.dataset.status;

            // Auto-fill amount with plan price
            document.getElementById('amount').value = opt.dataset.price;

            preview.classList.add('visible');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const sel = document.getElementById('subscription_id');
            if (sel.value) updateSubPreview();
        });
    </script>

</x-app-layout>