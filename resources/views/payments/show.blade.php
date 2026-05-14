@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                <i class="fas fa-credit-card mr-2" style="color: #FF6B35"></i>Payment Details
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('payments.invoice', $payment) }}"
                   class="px-4 py-2 text-white font-semibold rounded-lg"
                   style="background: linear-gradient(135deg, #22C55E, #16A34A)">
                    <i class="fas fa-file-invoice mr-2"></i>Invoice
                </a>
                <a href="{{ route('payments.edit', $payment) }}"
                   class="px-4 py-2 text-white font-semibold rounded-lg"
                   style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('payments.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Member</p>
                <p class="font-bold text-gray-800">{{ $payment->member->user->name }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Membership Plan</p>
                <p class="font-bold text-gray-800">{{ $payment->membershipPlan->name }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Amount</p>
                <p class="font-bold text-green-600 text-xl">UGX {{ number_format($payment->amount, 0) }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Payment Method</p>
                <p class="font-bold text-gray-800 capitalize">{{ $payment->payment_method }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Payment Date</p>
                <p class="font-bold text-gray-800">{{ $payment->payment_date }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Status</p>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' :
                       ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Start Date</p>
                <p class="font-bold text-gray-800">{{ $payment->start_date }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">End Date</p>
                <p class="font-bold text-gray-800">{{ $payment->end_date }}</p>
            </div>
        </div>
    </div>
</div>

@endsection