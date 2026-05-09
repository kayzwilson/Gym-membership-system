@extends('layouts.app')

@section('title', 'Record Attendance')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-calendar-plus mr-2" style="color: #22C55E"></i>Record Attendance
        </h2>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('attendance.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Member</label>
                <select name="member_id" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#22C55E'"
                    onblur="this.style.borderColor='#e5e7eb'">
                    <option value="">Select Member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#22C55E'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Check In</label>
                    <input type="time" name="check_in" value="{{ old('check_in') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#22C55E'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Check Out</label>
                    <input type="time" name="check_out" value="{{ old('check_out') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#22C55E'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 text-white font-bold rounded-lg shadow transition hover:opacity-90"
                    style="background: linear-gradient(135deg, #22C55E, #16A34A)">
                    <i class="fas fa-save mr-2"></i>Save Attendance
                </button>
                <a href="{{ route('attendance.index') }}"
                   class="px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection