@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-700">Attendance Records</h2>
    <a href="{{ route('attendance.create') }}"
       class="px-5 py-2 text-white font-semibold rounded-lg shadow transition hover:opacity-90"
       style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
        <i class="fas fa-plus mr-2"></i>Record Attendance
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <tr>
                <th class="text-left text-white px-6 py-4">#</th>
                <th class="text-left text-white px-6 py-4">Member</th>
                <th class="text-left text-white px-6 py-4">Date</th>
                <th class="text-left text-white px-6 py-4">Check In</th>
                <th class="text-left text-white px-6 py-4">Check Out</th>
                <th class="text-left text-white px-6 py-4">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($attendances as $attendance)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $attendance->member->user->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $attendance->date }}</td>
                <td class="px-6 py-4 font-semibold text-green-600">{{ $attendance->check_in }}</td>
                <td class="px-6 py-4 font-semibold text-red-500">{{ $attendance->check_out ?? 'Still in gym' }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('attendance.edit', $attendance) }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form method="POST" action="{{ route('attendance.destroy', $attendance) }}"
                              onsubmit="return confirm('Delete this record?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-calendar-check text-4xl mb-3 block" style="color: #22C55E"></i>
                    No attendance records yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">
        {{ $attendances->links() }}
    </div>
</div>

@endsection