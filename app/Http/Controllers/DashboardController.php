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
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'active')->count();
        $totalPlans = MembershipPlan::count();
        $totalPayments = Payment::sum('amount');
        $recentMembers = Member::with('user')->latest()->take(5)->get();
        $recentPayments = Payment::with('member.user', 'membershipPlan')
            ->latest()->take(5)->get();
        $todayAttendance = Attendance::whereDate('date', today())->count();

        return view('dashboard', compact(
            'totalMembers',
            'activeMembers',
            'totalPlans',
            'totalPayments',
            'recentMembers',
            'recentPayments',
            'todayAttendance'
        ));
    }
}