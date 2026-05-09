<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'emergency_contact' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        Member::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'emergency_contact' => $request->emergency_contact,
            'status' => 'active',
        ]);

        return redirect()->route('members.index')
            ->with('success', 'Member created successfully!');
    }

    public function show(Member $member)
    {
        $member->load('user', 'payments.membershipPlan', 'attendance');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'emergency_contact' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        $member->user->update(['name' => $request->name]);

        $member->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'emergency_contact' => $request->emergency_contact,
            'status' => $request->status,
        ]);

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully!');
    }

    public function destroy(Member $member)
    {
        $member->user->delete();
        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully!');
    }
}