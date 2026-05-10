<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:members,email',
            'phone'  => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'dob'    => 'nullable|date|before:today',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Member registered successfully.');
    }

    public function show(Member $member)
    {
        $member->load('subscriptions.plan', 'subscriptions.payment');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:members,email,' . $member->id,
            'phone'  => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'dob'    => 'nullable|date|before:today',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member removed successfully.');
    }
}