@extends('layouts.app')

@section('title', 'Edit Membership Plan')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-edit mr-2" style="color: #FF6B35"></i>Edit Membership Plan
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

        <form method="POST" action="{{ route('membership_plans.update', $membershipPlan) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Plan Name</label>
                <input type="text" name="name" value="{{ old('name', $membershipPlan->name) }}" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">{{ old('description', $membershipPlan->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price ($)</label>
                    <input type="number" name="price" value="{{ old('price', $membershipPlan->price) }}" required step="0.01" min="0"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Duration (days)</label>
                    <input type="number" name="duration_days" value="{{ old('duration_days', $membershipPlan->duration_days) }}" required min="1"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">
                    <option value="active" {{ $membershipPlan->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $membershipPlan->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit"
                    class="px-8 py-3 text-white font-bold rounded-lg shadow transition hover:opacity-90"
                    style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-save mr-2"></i>Update Plan
                </button>
                <a href="{{ route('membership_plans.index') }}"
                   class="px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
