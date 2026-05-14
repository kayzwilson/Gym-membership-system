@extends('layouts.app')

@section('title', 'Payments')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-700">All Payments</h2>
    <a href="{{ route('payments.create') }}"
       class="px-5 py-2 text-white font-semibold rounded-lg shadow transition hover:opacity-90"
       style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
        <i class="fas fa-plus mr-2"></i>Record Payment
    </a>
    
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <tr>
                <th class="text-left text-white px-6 py-4">#</th>
                <th class="text-left text-white px-6 py-4">Member</th>
                <th class="text-left text-white px-6 py-4">Plan</th>
                <th class="text-left text-white px-6 py-4">Amount</th>
                <th class="text-left text-white px-6 py-4">Date</th>
                <th class="text-left text-white px-6 py-4">Method</th>
                <th class="text-left text-white px-6 py-4">Status</th>
                <th class="text-left text-white px-6 py-4">Actions</th>
            </tr>
        </thead>
       <tbody class="divide-y divide-gray-100">
    @forelse($payments as $payment)
    <tr class="hover:bg-gray-50 transition">
        <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 font-semibold text-gray-800">{{ $payment->member->user->name }}</td>
        <td class="px-6 py-4 text-gray-600">{{ $payment->membershipPlan->name }}</td>
        <td class="px-6 py-4 font-bold text-green-600">UGX {{ number_format($payment->amount, 2) }}</td>
        <td class="px-6 py-4 text-gray-600">{{ $payment->payment_date }}</td>
        <td class="px-6 py-4 text-gray-600 capitalize">{{ $payment->payment_method }}</td>
        <td class="px-6 py-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold
                {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' :
                   ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($payment->status) }}
            </span>
        </td>
        <td class="px-6 py-4">
            <div class="flex items-center space-x-2">

            <a href="{{ route('payments.show', $payment) }}"
       title="View Details"
       class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
        <i class="fas fa-eye text-xs"></i>
    </a>
    
                <a href="{{ route('payments.invoice', $payment) }}" 
                   title="Download Receipt"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                    <i class="fas fa-file-invoice text-xs"></i>
                </a>

                <a href="{{ route('payments.edit', $payment) }}"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition">
                    <i class="fas fa-edit text-xs"></i>
                </a>



                <form method="POST" action="{{ route('payments.destroy', $payment) }}"
                      onsubmit="return confirm('Delete this payment?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    @endforelse
</tbody>
    </table>
    <div class="px-6 py-4 border-t">
        {{ $payments->links() }}
    </div>
</div>

@endsection
