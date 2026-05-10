<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['member', 'plan', 'payment'])
            ->latest()
            ->paginate(10);

        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $plans   = MembershipPlan::orderBy('name')->get();
        return view('subscriptions.create', compact('members', 'plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id'          => 'required|exists:members,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'start_date'         => 'required|date',
        ]);

        $plan     = MembershipPlan::findOrFail($validated['membership_plan_id']);
        $start    = \Carbon\Carbon::parse($validated['start_date']);
        $end      = $start->copy()->addDays($plan->duration_days);

        Subscription::create([
            'member_id'          => $validated['member_id'],
            'membership_plan_id' => $validated['membership_plan_id'],
            'start_date'         => $start,
            'end_date'           => $end,
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription assigned successfully. End date: ' . $end->format('d M Y'));
    }

    public function show(Subscription $subscription)
    {
        return redirect()->route('subscriptions.index');
    }

    public function edit(Subscription $subscription)
    {
        $members = Member::orderBy('name')->get();
        $plans   = MembershipPlan::orderBy('name')->get();
        return view('subscriptions.edit', compact('subscription', 'members', 'plans'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'member_id'          => 'required|exists:members,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'start_date'         => 'required|date',
        ]);

        $plan  = MembershipPlan::findOrFail($validated['membership_plan_id']);
        $start = \Carbon\Carbon::parse($validated['start_date']);
        $end   = $start->copy()->addDays($plan->duration_days);

        $subscription->update([
            'member_id'          => $validated['member_id'],
            'membership_plan_id' => $validated['membership_plan_id'],
            'start_date'         => $start,
            'end_date'           => $end,
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated. New end date: ' . $end->format('d M Y'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription removed successfully.');
    }
}