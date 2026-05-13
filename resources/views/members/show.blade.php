@extends('layouts.app')

@section('title', 'Member Details')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Member Info Card --}}
    <div class="bg-white rounded-xl shadow-sm p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl font-bold"
                     style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    {{ strtoupper(substr($member->user->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $member->user->name }}</h2>
                    <p class="text-gray-500">{{ $member->user->email }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('members.edit', $member) }}"
                   class="px-4 py-2 text-white font-semibold rounded-lg"
                   style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('members.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Phone</p>
                <p class="font-semibold text-gray-800">{{ $member->phone }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Gender</p>
                <p class="font-semibold text-gray-800 capitalize">{{ $member->gender }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Date of Birth</p>
                <p class="font-semibold text-gray-800">{{ $member->date_of_birth }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Status</p>
                <span class="px-2 py-1 rounded-full text-xs font-semibold
                    {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($member->status) }}
                </span>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 col-span-2">
                <p class="text-xs text-gray-500 mb-1">Address</p>
                <p class="font-semibold text-gray-800">{{ $member->address }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 col-span-2">
                <p class="text-xs text-gray-500 mb-1">Emergency Contact</p>
                <p class="font-semibold text-gray-800">{{ $member->emergency_contact ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    {{-- Payment History --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-credit-card mr-2" style="color: #FF1493"></i>Payment History
        </h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50">
                    <th class="text-left px-4 py-3 text-gray-600">Plan</th>
                    <th class="text-left px-4 py-3 text-gray-600">Amount</th>
                    <th class="text-left px-4 py-3 text-gray-600">Date</th>
                    <th class="text-left px-4 py-3 text-gray-600">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($member->payments as $payment)
                <tr>
                    <td class="px-4 py-3">{{ $payment->membershipPlan->name }}</td>
                    <td class="px-4 py-3 font-semibold text-green-600">UGX {{ number_format($payment->amount, 2) }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $payment->payment_date }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' : 
                               ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">No payments yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Attendance History --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-calendar-check mr-2" style="color: #22C55E"></i>Attendance History
        </h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50">
                    <th class="text-left px-4 py-3 text-gray-600">Date</th>
                    <th class="text-left px-4 py-3 text-gray-600">Check In</th>
                    <th class="text-left px-4 py-3 text-gray-600">Check Out</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($member->attendance as $record)
                <tr>
                    <td class="px-4 py-3 text-gray-700">{{ $record->date }}</td>
                    <td class="px-4 py-3 text-green-600 font-semibold">{{ $record->check_in }}</td>
                    <td class="px-4 py-3 text-red-500 font-semibold">{{ $record->check_out ?? 'Still in gym' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">No attendance records yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
