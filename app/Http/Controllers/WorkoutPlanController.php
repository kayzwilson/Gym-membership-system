<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    public function index()
    {
        $workoutPlans = WorkoutPlan::with('trainer', 'member.user')->latest()->paginate(10);
        return view('workout_plans.index', compact('workoutPlans'));
    }

    public function create()
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $trainers = User::where('role', 'trainer')->get();
        return view('workout_plans.create', compact('members', 'trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainer_id' => 'required|exists:users,id',
            'member_id' => 'required|exists:members,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        WorkoutPlan::create($request->all());

        return redirect()->route('workout_plans.index')
            ->with('success', 'Workout plan created successfully!');
    }

    public function show(WorkoutPlan $workoutPlan)
    {
        $workoutPlan->load('trainer', 'member.user');
        return view('workout_plans.show', compact('workoutPlan'));
    }

    public function edit(WorkoutPlan $workoutPlan)
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $trainers = User::where('role', 'trainer')->get();
        return view('workout_plans.edit', compact('workoutPlan', 'members', 'trainers'));
    }

    public function update(Request $request, WorkoutPlan $workoutPlan)
    {
        $request->validate([
            'trainer_id' => 'required|exists:users,id',
            'member_id' => 'required|exists:members,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $workoutPlan->update($request->all());

        return redirect()->route('workout_plans.index')
            ->with('success', 'Workout plan updated successfully!');
    }

    public function destroy(WorkoutPlan $workoutPlan)
    {
        $workoutPlan->delete();
        return redirect()->route('workout_plans.index')
            ->with('success', 'Workout plan deleted successfully!');
    }
}