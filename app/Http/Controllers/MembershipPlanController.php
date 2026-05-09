<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::latest()->paginate(10);
        return view('membership_plans.index', compact('plans'));
    }

    public function create()
    {
        return view('membership_plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        MembershipPlan::create($request->all());

        return redirect()->route('membership_plans.index')
            ->with('success', 'Membership plan created successfully!');
    }

    public function show(MembershipPlan $membershipPlan)
    {
        return view('membership_plans.show', compact('membershipPlan'));
    }

    public function edit(MembershipPlan $membershipPlan)
    {
        return view('membership_plans.edit', compact('membershipPlan'));
    }

    public function update(Request $request, MembershipPlan $membershipPlan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $membershipPlan->update($request->all());

        return redirect()->route('membership_plans.index')
            ->with('success', 'Membership plan updated successfully!');
    }

    public function destroy(MembershipPlan $membershipPlan)
    {
        $membershipPlan->delete();
        return redirect()->route('membership_plans.index')
            ->with('success', 'Membership plan deleted successfully!');
    }
}