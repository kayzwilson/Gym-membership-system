@extends('layouts.app')

@section('title', 'Record Payment')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-credit-card mr-2" style="color: #FF6B35"></i>Record New Payment
        </h2>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('payments.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Member</label>
                <select name="member_id" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">
                    <option value="">Select Member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Membership Plan</label>
                <select name="membership_plan_id" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">
                    <option value="">Select Plan</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }} - UGX {{ number_format($plan->price, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Amount (UGX)</label>
                    <input type="number" name="amount" value="{{ old('amount') }}" required step="0.01" min="0"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'"
                        placeholder="0.00">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                    <select name="payment_method" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Date</label>
                    <input type="date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 text-white font-bold rounded-lg shadow transition hover:opacity-90"
                    style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-save mr-2"></i>Save Payment
                </button>
                <a href="{{ route('payments.index') }}"
                   class="px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
