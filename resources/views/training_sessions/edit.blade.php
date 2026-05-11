@extends('layouts.app')
@section('title', 'Edit Training Session')
@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-edit mr-2" style="color: #FF6B35"></i>Edit Training Session
        </h2>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('training_sessions.update', $trainingSession) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Session Title</label>
                <input type="text" name="title" value="{{ old('title', $trainingSession->title) }}" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Member</label>
                    <select name="member_id" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ $trainingSession->member_id == $member->id ? 'selected' : '' }}>
                                {{ $member->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Trainer</label>
                    <select name="trainer_id" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ $trainingSession->trainer_id == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Session Date</label>
                    <input type="date" name="session_date" value="{{ old('session_date', $trainingSession->session_date) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
                        <option value="scheduled" {{ $trainingSession->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="completed" {{ $trainingSession->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $trainingSession->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Start Time</label>
                    <input type="time" name="start_time" value="{{ old('start_time', $trainingSession->start_time) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">End Time</label>
                    <input type="time" name="end_time" value="{{ old('end_time', $trainingSession->end_time) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                <textarea name="notes" rows="3"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'" onblur="this.style.borderColor='#e5e7eb'">{{ old('notes', $trainingSession->notes) }}</textarea>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 text-white font-bold rounded-lg shadow transition hover:opacity-90"
                    style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-save mr-2"></i>Update Session
                </button>
                <a href="{{ route('training_sessions.index') }}"
                   class="px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection