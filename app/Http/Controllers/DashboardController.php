<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\Attendance;

class DashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();

    if ($user->isAdmin()) {
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'active')->count();
        $totalPlans = MembershipPlan::count();
        $totalPayments = Payment::sum('amount');
        $recentMembers = Member::with('user')->latest()->take(5)->get();
        $recentPayments = Payment::with('member.user', 'membershipPlan')
            ->latest()->take(5)->get();
        $todayAttendance = Attendance::whereDate('date', today())->count();
    } elseif ($user->isStaff()) {
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'active')->count();
        $totalPlans = MembershipPlan::count();
        $totalPayments = 0;
        $recentMembers = Member::with('user')->latest()->take(5)->get();
        $recentPayments = collect();
        $todayAttendance = Attendance::whereDate('date', today())->count();
    } else {
        // Member
        $member = $user->member;
        $totalMembers = 0;
        $activeMembers = 0;
        $totalPlans = 0;
        $totalPayments = $member ? Payment::where('member_id', $member->id)->sum('amount') : 0;
        $recentMembers = collect();
        $recentPayments = $member ? Payment::with('membershipPlan')
            ->where('member_id', $member->id)->latest()->take(5)->get() : collect();
        $todayAttendance = $member ? Attendance::where('member_id', $member->id)
            ->whereDate('date', today())->count() : 0;
    }

    return view('dashboard', compact(
        'totalMembers', 'activeMembers', 'totalPlans',
        'totalPayments', 'recentMembers', 'recentPayments', 'todayAttendance'
    ));
}
}