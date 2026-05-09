@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    {{-- Total Members --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <i class="fas fa-users text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Members</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalMembers }}</p>
        </div>
    </div>

    {{-- Active Members --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
            <i class="fas fa-user-check text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Active Members</p>
            <p class="text-3xl font-bold text-gray-800">{{ $activeMembers }}</p>
        </div>
    </div>

    {{-- Today's Attendance --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF1493, #FF6B35)">
            <i class="fas fa-calendar-check text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Today's Attendance</p>
            <p class="text-3xl font-bold text-gray-800">{{ $todayAttendance }}</p>
        </div>
    </div>

    {{-- Total Revenue --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
            <i class="fas fa-dollar-sign text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-3xl font-bold text-gray-800">${{ number_format($totalPayments, 2) }}</p>
        </div>
    </div>
</div>

{{-- Recent Members & Payments --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent Members --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-users mr-2" style="color: #FF6B35"></i>Recent Members
            </h2>
            <a href="{{ route('members.index') }}" 
               class="text-sm font-semibold hover:underline"
               style="color: #FF6B35">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recentMembers as $member)
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold"
                         style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                        {{ strtoupper(substr($member->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $member->user->name }}</p>
                        <p class="text-gray-500 text-xs">{{ $member->user->email }}</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($member->status) }}
                </span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No members yet</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Payments --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-credit-card mr-2" style="color: #FF1493"></i>Recent Payments
            </h2>
            <a href="{{ route('payments.index') }}" 
               class="text-sm font-semibold hover:underline"
               style="color: #FF1493">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recentPayments as $payment)
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $payment->member->user->name }}</p>
                    <p class="text-gray-500 text-xs">{{ $payment->membershipPlan->name }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">${{ number_format($payment->amount, 2) }}</p>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' : 
                           ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No payments yet</p>
            @endforelse
        </div>
    </div>
</div>

@endsection