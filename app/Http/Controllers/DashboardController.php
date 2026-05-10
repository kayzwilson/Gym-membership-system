<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers        = Member::count();
        $activeSubscriptions = Subscription::where('end_date', '>=', now())->count();
        $expiringSoon        = Subscription::whereBetween('end_date', [now(), now()->addDays(7)])->count();
        $totalRevenue        = Payment::sum('amount');

        $recentMembers = Member::latest()->take(6)->get();

        $expiringSoonList = Subscription::with('member')
            ->where('end_date', '<=', now()->addDays(7))
            ->where('end_date', '>=', now()->subDays(1))
            ->orderBy('end_date')
            ->take(6)
            ->get();

        return view('dashboard', compact(
            'totalMembers',
            'activeSubscriptions',
            'expiringSoon',
            'totalRevenue',
            'recentMembers',
            'expiringSoonList'
        ));
    }
}