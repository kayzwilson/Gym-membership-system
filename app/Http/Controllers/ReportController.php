<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Revenue by month
        $monthlyRevenue = Payment::selectRaw('MONTH(payment_date) as month, YEAR(payment_date) as year, SUM(amount) as total')
            ->where('status', 'paid')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        // Membership stats
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->sum('amount');
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'active')->count();
        $inactiveMembers = Member::where('status', 'inactive')->count();

        // Attendance this month
        $monthlyAttendance = Attendance::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        // Plan popularity
        $planStats = MembershipPlan::withCount('payments')->get();

        // Recent payments
        $recentPayments = Payment::with('member.user', 'membershipPlan')
            ->where('status', 'paid')
            ->latest()
            ->take(10)
            ->get();

        // Expiring memberships
        $expiringMemberships = Payment::with('member.user', 'membershipPlan')
            ->where('status', 'paid')
            ->whereBetween('end_date', [now(), now()->addDays(7)])
            ->get();

        return view('reports.index', compact(
            'monthlyRevenue', 'totalRevenue', 'pendingPayments',
            'totalMembers', 'activeMembers', 'inactiveMembers',
            'monthlyAttendance', 'planStats', 'recentPayments',
            'expiringMemberships'
        ));
    }
}