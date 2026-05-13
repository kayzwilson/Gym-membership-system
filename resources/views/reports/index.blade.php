@extends('layouts.app')
@section('title', 'Reports & Analytics')
@section('content')

{{-- Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <i class="fas fa-dollar-sign text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-2xl font-bold text-gray-800">UGX {{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-yellow-500">
            <i class="fas fa-clock text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Pending Payments</p>
            <p class="text-2xl font-bold text-gray-800">UGX {{ number_format($pendingPayments, 2) }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
            <i class="fas fa-users text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Active Members</p>
            <p class="text-2xl font-bold text-gray-800">{{ $activeMembers }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF1493, #FF6B35)">
            <i class="fas fa-calendar-check text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">This Month Attendance</p>
            <p class="text-2xl font-bold text-gray-800">{{ $monthlyAttendance }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    {{-- Plan Popularity --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-chart-pie mr-2" style="color: #FF6B35"></i>Plan Popularity
        </h3>
        <div class="space-y-3">
            @foreach($planStats as $plan)
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-semibold text-gray-700">{{ $plan->name }}</span>
                    <span class="text-gray-500">{{ $plan->payments_count }} payments</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-3">
                    @php
                        $max = $planStats->max('payments_count');
                        $width = $max > 0 ? ($plan->payments_count / $max) * 100 : 0;
                    @endphp
                    <div class="h-3 rounded-full transition-all"
                         style="width: {{ $width }}%; background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Member Stats --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-chart-bar mr-2" style="color: #FF1493"></i>Member Statistics
        </h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                        <i class="fas fa-user-check text-white"></i>
                    </div>
                    <span class="font-semibold text-gray-700">Active Members</span>
                </div>
                <span class="text-2xl font-bold text-green-600">{{ $activeMembers }}</span>
            </div>
            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-red-400 flex items-center justify-center">
                        <i class="fas fa-user-times text-white"></i>
                    </div>
                    <span class="font-semibold text-gray-700">Inactive Members</span>
                </div>
                <span class="text-2xl font-bold text-red-500">{{ $inactiveMembers }}</span>
            </div>
            <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center"
                         style="background: #FF6B35">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <span class="font-semibold text-gray-700">Total Members</span>
                </div>
                <span class="text-2xl font-bold" style="color: #FF6B35">{{ $totalMembers }}</span>
            </div>
        </div>
    </div>
</div>

{{-- Expiring Memberships --}}
@if($expiringMemberships->count() > 0)
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">
        <i class="fas fa-exclamation-triangle mr-2 text-yellow-500"></i>
        Memberships Expiring Within 7 Days
    </h3>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-yellow-50">
                <th class="text-left px-4 py-3 text-gray-600">Member</th>
                <th class="text-left px-4 py-3 text-gray-600">Plan</th>
                <th class="text-left px-4 py-3 text-gray-600">Expiry Date</th>
                <th class="text-left px-4 py-3 text-gray-600">Days Left</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($expiringMemberships as $payment)
            <tr>
                <td class="px-4 py-3 font-semibold text-gray-800">{{ $payment->member->user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $payment->membershipPlan->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $payment->end_date }}</td>
                <td class="px-4 py-3">
                    @php $daysLeft = now()->diffInDays($payment->end_date, false); @endphp
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        {{ $daysLeft <= 2 ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $daysLeft }} days
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- Recent Payments --}}
<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">
        <i class="fas fa-credit-card mr-2" style="color: #FF1493"></i>Recent Payments
    </h3>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50">
                <th class="text-left px-4 py-3 text-gray-600">Member</th>
                <th class="text-left px-4 py-3 text-gray-600">Plan</th>
                <th class="text-left px-4 py-3 text-gray-600">Amount</th>
                <th class="text-left px-4 py-3 text-gray-600">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($recentPayments as $payment)
            <tr>
                <td class="px-4 py-3 font-semibold text-gray-800">{{ $payment->member->user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $payment->membershipPlan->name }}</td>
                <td class="px-4 py-3 font-bold text-green-600">UGX {{ number_format($payment->amount, 2) }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $payment->payment_date }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center text-gray-500">No payments yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
