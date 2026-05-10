<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::withCount('subscriptions')->latest()->get();
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255|unique:membership_plans,name',
            'price'         => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'description'   => 'nullable|string|max:500',
        ]);

        MembershipPlan::create($validated);

        return redirect()->route('plans.index')
            ->with('success', 'Membership plan created successfully.');
    }

    public function edit(MembershipPlan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, MembershipPlan $plan)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255|unique:membership_plans,name,' . $plan->id,
            'price'         => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'description'   => 'nullable|string|max:500',
        ]);

        $plan->update($validated);

        return redirect()->route('plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    public function destroy(MembershipPlan $plan)
    {
        if ($plan->subscriptions()->exists()) {
            return redirect()->route('plans.index')
                ->with('error', 'Cannot delete a plan that has active subscriptions.');
        }

        $plan->delete();

        return redirect()->route('plans.index')
            ->with('success', 'Plan deleted successfully.');
    }

    public function show(MembershipPlan $plan)
    {
        return redirect()->route('plans.index');
    }
}