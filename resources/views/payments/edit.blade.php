<x-app-layout>
    <x-slot name="title">Edit Payment</x-slot>

    <style>
        .method-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
        .method-option { display: none; }
        .method-label {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; gap: 8px; padding: 16px 12px;
            border-radius: 10px; border: 1px solid var(--border);
            background: var(--black); cursor: pointer; transition: all .2s; text-align: center;
        }
        .method-label:hover { border-color: #333; }
        .method-option:checked + .method-label { border-color: var(--red); background: rgba(192,57,43,.08); }
        .method-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: rgba(192,57,43,.1); }
        .method-icon svg { width: 16px; height: 16px; stroke: var(--red); fill: none; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
        .method-name { font-size: 13px; font-weight: 500; color: var(--white); }
    </style>

    <div class="page-header">
        <div>
            <h1>Edit Payment</h1>
            <p>Update payment record</p>
        </div>
        <a href="{{ route('payments.index') }}" class="btn-ghost">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap: round; stroke-linejoin: round">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Back to payments
        </a>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('payments.update', $payment) }}">
            @csrf
            @method('PUT')

            <div class="form-grid-2">

                <div class="field full">
                    <label for="subscription_id">Subscription <span style="color:var(--red)">*</span></label>
                    <select id="subscription_id" name="subscription_id" required>
                        @foreach($subscriptions as $sub)
                            <option value="{{ $sub->id }}"
                                {{ old('subscription_id', $payment->subscription_id) == $sub->id ? 'selected' : '' }}>
                                {{ $sub->member->name }} — {{ $sub->plan->name }}
                                ({{ $sub->start_date->format('d M Y') }} → {{ $sub->end_date->format('d M Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('subscription_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="amount">Amount (UGX) <span style="color:var(--red)">*</span></label>
                    <input type="number" id="amount" name="amount"
                           value="{{ old('amount', $payment->amount) }}"
                           min="0" step="500" required>
                    @error('amount')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label>Payment method <span style="color:var(--red)">*</span></label>
                    <div class="method-grid">
                        @foreach(['Cash', 'Mobile Money', 'Card'] as $m)
                            <div>
                                <input type="radio" id="method_{{ Str::slug($m) }}"
                                       name="method" value="{{ $m }}"
                                       class="method-option"
                                       {{ old('method', $payment->method) === $m ? 'checked' : '' }}>
                                <label for="method_{{ Str::slug($m) }}" class="method-label">
                                    <div class="method-icon">
                                        @if($m === 'Cash')
                                            <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                        @elseif($m === 'Mobile Money')
                                            <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                        @else
                                            <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                        @endif
                                    </div>
                                    <span class="method-name">{{ $m }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('method')<span class="field-error" style="margin-top:8px; display:block;">{{ $message }}</span>@enderror
                </div>

                <div class="field full">
                    <label for="payment_date">Payment date <span style="color:var(--red)">*</span></label>
                    <input type="date" id="payment_date" name="payment_date"
                           value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}"
                           required>
                    @error('payment_date')<span class="field-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save changes
                </button>
                <a href="{{ route('payments.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</x-app-layout>