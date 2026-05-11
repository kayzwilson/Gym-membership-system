<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\WorkoutPlan;
use App\Models\TrainingSession;
use App\Models\Notification;

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
            $totalSessions = TrainingSession::count();
            $unreadNotifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)->count();

        } elseif ($user->isTrainer()) {
            $totalMembers = Member::count();
            $activeMembers = Member::where('status', 'active')->count();
            $totalPlans = MembershipPlan::count();
            $totalPayments = 0;
            $recentMembers = Member::with('user')->latest()->take(5)->get();
            $recentPayments = collect();
            $todayAttendance = Attendance::whereDate('date', today())->count();
            $totalSessions = TrainingSession::where('trainer_id', $user->id)->count();
            $unreadNotifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)->count();

        } else {
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
            $totalSessions = $member ? TrainingSession::where('member_id', $member->id)->count() : 0;
            $unreadNotifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)->count();
        }

        return view('dashboard', compact(
            'totalMembers', 'activeMembers', 'totalPlans',
            'totalPayments', 'recentMembers', 'recentPayments',
            'todayAttendance', 'totalSessions', 'unreadNotifications'
        ));
    }
}