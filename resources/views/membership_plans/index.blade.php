@extends('layouts.app')

@section('title', 'Membership Plans')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-700">All Membership Plans</h2>
    <a href="{{ route('membership_plans.create') }}"
       class="px-5 py-2 text-white font-semibold rounded-lg shadow transition hover:opacity-90"
       style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
        <i class="fas fa-plus mr-2"></i>Add Plan
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($plans as $plan)
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-1" style="background: linear-gradient(135deg, #FF6B35, #FF1493)"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">{{ $plan->name }}</h3>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $plan->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($plan->status) }}
                </span>
            </div>
            <p class="text-gray-500 text-sm mb-4">{{ $plan->description ?? 'No description' }}</p>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-xs text-gray-500">Price</p>
                    <p class="text-2xl font-bold" style="color: #FF6B35">${{ number_format($plan->price, 2) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500">Duration</p>
                    <p class="text-lg font-bold text-gray-700">{{ $plan->duration_days }} days</p>
                </div>
            </div>
            <div class="flex items-center space-x-2 pt-4 border-t">
                <a href="{{ route('membership_plans.edit', $plan) }}"
                   class="flex-1 py-2 text-center text-white font-semibold rounded-lg transition hover:opacity-90"
                   style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                <form method="POST" action="{{ route('membership_plans.destroy', $plan) }}"
                      onsubmit="return confirm('Delete this plan?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-600 font-semibold rounded-lg hover:bg-red-200 transition">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-white rounded-xl shadow-sm p-12 text-center">
        <i class="fas fa-clipboard-list text-5xl mb-4 block" style="color: #FF6B35"></i>
        <p class="text-gray-500">No plans yet. <a href="{{ route('membership_plans.create') }}" 
           style="color: #FF6B35" class="font-semibold hover:underline">Add one now!</a></p>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $plans->links() }}
</div>

@endsection