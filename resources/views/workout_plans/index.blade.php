@extends('layouts.app')
@section('title', 'Workout Plans')
@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-700">Workout Plans</h2>
    <a href="{{ route('workout_plans.create') }}"
       class="px-5 py-2 text-white font-semibold rounded-lg shadow"
       style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
        <i class="fas fa-plus mr-2"></i>Add Plan
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <tr>
                <th class="text-left text-white px-6 py-4">#</th>
                <th class="text-left text-white px-6 py-4">Title</th>
                <th class="text-left text-white px-6 py-4">Member</th>
                <th class="text-left text-white px-6 py-4">Trainer</th>
                <th class="text-left text-white px-6 py-4">Difficulty</th>
                <th class="text-left text-white px-6 py-4">Status</th>
                <th class="text-left text-white px-6 py-4">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($workoutPlans as $plan)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 font-semibold text-gray-800">{{ $plan->title }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $plan->member->user->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $plan->trainer->name }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $plan->difficulty === 'beginner' ? 'bg-green-100 text-green-700' :
                           ($plan->difficulty === 'intermediate' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($plan->difficulty) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $plan->status === 'active' ? 'bg-green-100 text-green-700' :
                           ($plan->status === 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($plan->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('workout_plans.edit', $plan) }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form method="POST" action="{{ route('workout_plans.destroy', $plan) }}"
                              onsubmit="return confirm('Delete this plan?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-dumbbell text-4xl mb-3 block" style="color: #FF6B35"></i>
                    No workout plans yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">{{ $workoutPlans->links() }}</div>
</div>
@endsection
