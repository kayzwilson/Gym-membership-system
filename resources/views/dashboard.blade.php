@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@if(auth()->user()->isAdmin())
{{-- ADMIN DASHBOARD --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
            <i class="fas fa-user-check text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Active Members</p>
            <p class="text-3xl font-bold text-gray-800">{{ $activeMembers }}</p>
        </div>
    </div>
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
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
       <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
    <i class="fas fa-money-bill-wave text-white text-xl"></i>
</div>
        <div>
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-3xl font-bold text-gray-800">UGX {{ number_format($totalPayments, 2) }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-users mr-2" style="color: #FF6B35"></i>Recent Members
            </h2>
            <a href="{{ route('members.index') }}" class="text-sm font-semibold hover:underline" style="color: #FF6B35">View All</a>
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

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-credit-card mr-2" style="color: #FF1493"></i>Recent Payments
            </h2>
            <a href="{{ route('payments.index') }}" class="text-sm font-semibold hover:underline" style="color: #FF1493">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recentPayments as $payment)
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $payment->member->user->name }}</p>
                    <p class="text-gray-500 text-xs">{{ $payment->membershipPlan->name }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">UGX {{ number_format($payment->amount, 2) }}</p>
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

@elseif(auth()->user()->isTrainer())
{{-- TRAINER DASHBOARD --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
            <i class="fas fa-user-check text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Active Members</p>
            <p class="text-3xl font-bold text-gray-800">{{ $activeMembers }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF1493, #FF6B35)">
            <i class="fas fa-stopwatch text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">My Sessions</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalSessions }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">
        <i class="fas fa-users mr-2" style="color: #FF6B35"></i>Recent Members
    </h2>
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
                    <p class="text-gray-500 text-xs">{{ $member->phone }}</p>
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

@else
{{-- MEMBER DASHBOARD --}}
@php $member = auth()->user()->member; @endphp

<div class="mb-6">
    <h2 class="text-xl font-bold text-gray-800">
        Welcome back, {{ auth()->user()->name }}! 👋
    </h2>
    <p class="text-gray-500 text-sm mt-1">Here's your fitness summary</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Membership Status --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <i class="fas fa-id-card text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">My Status</p>
            <p class="text-xl font-bold {{ $member && $member->status === 'active' ? 'text-green-600' : 'text-red-500' }}">
                {{ $member ? ucfirst($member->status) : 'Not Registered' }}
            </p>
        </div>
    </div>

    {{-- Total Paid --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center bg-green-500">
    <i class="fas fa-money-bill-wave text-white text-xl"></i>
</div>
        <div>
            <p class="text-gray-500 text-sm">Total Paid</p>
            <p class="text-3xl font-bold text-gray-800">UGX {{ number_format($totalPayments, 2) }}</p>
        </div>
    </div>

    {{-- My Sessions --}}
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
        <div class="w-14 h-14 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, #FF1493, #FF6B35)">
            <i class="fas fa-stopwatch text-white text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">My Sessions</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalSessions }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- My Payment History --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-credit-card mr-2" style="color: #FF1493"></i>My Payment History
        </h2>
        <div class="space-y-4">
            @forelse($recentPayments as $payment)
            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ $payment->membershipPlan->name }}</p>
                    <p class="text-gray-500 text-xs">{{ $payment->payment_date }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">UGX {{ number_format($payment->amount, 2) }}</p>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' :
                           ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center py-6">
                <i class="fas fa-credit-card text-3xl text-gray-300 mb-2 block"></i>
                <p class="text-gray-500 text-sm">No payments yet</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- My Attendance --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">
            <i class="fas fa-calendar-check mr-2" style="color: #22C55E"></i>My Recent Attendance
        </h2>
        <div class="space-y-3">
            @if($member)
                @forelse($member->attendance()->latest()->take(5)->get() as $record)
                <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $record->date }}</p>
                        <p class="text-gray-500 text-xs">
                            Check in: <span class="text-green-600 font-semibold">{{ $record->check_in }}</span>
                        </p>
                    </div>
                    <p class="text-xs text-red-500 font-semibold">
                        Out: {{ $record->check_out ?? 'Still in gym' }}
                    </p>
                </div>
                @empty
                <div class="text-center py-6">
                    <i class="fas fa-calendar text-3xl text-gray-300 mb-2 block"></i>
                    <p class="text-gray-500 text-sm">No attendance records yet</p>
                </div>
                @endforelse
            @else
                <div class="text-center py-6">
                    <i class="fas fa-calendar text-3xl text-gray-300 mb-2 block"></i>
                    <p class="text-gray-500 text-sm">No attendance records yet</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- My Training Sessions --}}
@if($member)
<div class="bg-white rounded-xl shadow-sm p-6 mt-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4">
        <i class="fas fa-stopwatch mr-2" style="color: #FF6B35"></i>My Upcoming Sessions
    </h2>
    <div class="space-y-3">
        @forelse($member->trainingSessions()->where('status', 'scheduled')->latest()->take(5)->get() as $session)
        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
            <div>
                <p class="font-semibold text-gray-800 text-sm">{{ $session->title }}</p>
                <p class="text-gray-500 text-xs">Trainer: {{ $session->trainer->name }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-semibold text-gray-700">{{ $session->session_date }}</p>
                <p class="text-xs text-gray-500">{{ $session->start_time }} - {{ $session->end_time }}</p>
            </div>
        </div>
        @empty
        <div class="text-center py-6">
            <i class="fas fa-stopwatch text-3xl text-gray-300 mb-2 block"></i>
            <p class="text-gray-500 text-sm">No upcoming sessions</p>
        </div>
        @endforelse
    </div>
</div>
@endif

@endif

@endsection
