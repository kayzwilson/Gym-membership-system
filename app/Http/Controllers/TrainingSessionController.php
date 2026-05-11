<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use App\Models\Member;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    public function index()
    {
        $sessions = TrainingSession::with('trainer', 'member.user')->latest()->paginate(10);
        return view('training_sessions.index', compact('sessions'));
    }

    public function create()
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $trainers = User::where('role', 'trainer')->get();
        return view('training_sessions.create', compact('members', 'trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainer_id' => 'required|exists:users,id',
            'member_id' => 'required|exists:members,id',
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'session_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $session = TrainingSession::create($request->all());

        // Notify member
        $member = Member::find($request->member_id);
        Notification::create([
            'user_id' => $member->user_id,
            'title' => 'New Training Session Scheduled',
            'message' => 'You have a new training session: ' . $request->title . ' on ' . $request->session_date . ' at ' . $request->start_time,
            'type' => 'session_reminder',
        ]);

        return redirect()->route('training_sessions.index')
            ->with('success', 'Training session created successfully!');
    }

    public function edit(TrainingSession $trainingSession)
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $trainers = User::where('role', 'trainer')->get();
        return view('training_sessions.edit', compact('trainingSession', 'members', 'trainers'));
    }

    public function update(Request $request, TrainingSession $trainingSession)
    {
        $request->validate([
            'trainer_id' => 'required|exists:users,id',
            'member_id' => 'required|exists:members,id',
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'session_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $trainingSession->update($request->all());

        return redirect()->route('training_sessions.index')
            ->with('success', 'Training session updated successfully!');
    }

    public function destroy(TrainingSession $trainingSession)
    {
        $trainingSession->delete();
        return redirect()->route('training_sessions.index')
            ->with('success', 'Training session deleted successfully!');
    }
}