<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('member.user')
            ->latest()->paginate(10);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $members = Member::with('user')->where('status', 'active')->get();
        return view('attendance.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance recorded successfully!');
    }

    public function edit(Attendance $attendance)
    {
        $members = Member::with('user')->where('status', 'active')->get();
        return view('attendance.edit', compact('attendance', 'members'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')
            ->with('success', 'Attendance deleted successfully!');
    }
}