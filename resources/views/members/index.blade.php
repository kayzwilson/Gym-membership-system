@extends('layouts.app')

@section('title', 'Members')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-700">All Members</h2>
    <a href="{{ route('members.create') }}"
       class="px-5 py-2 text-white font-semibold rounded-lg shadow transition hover:opacity-90"
       style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
        <i class="fas fa-plus mr-2"></i>Add Member
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <tr>
                <th class="text-left text-white px-6 py-4">#</th>
                <th class="text-left text-white px-6 py-4">Name</th>
                <th class="text-left text-white px-6 py-4">Email</th>
                <th class="text-left text-white px-6 py-4">Phone</th>
                <th class="text-left text-white px-6 py-4">Gender</th>
                <th class="text-left text-white px-6 py-4">Status</th>
                <th class="text-left text-white px-6 py-4">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($members as $member)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                             style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                            {{ strtoupper(substr($member->user->name, 0, 1)) }}
                        </div>
                        <span class="font-semibold text-gray-800">{{ $member->user->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $member->user->email }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $member->phone }}</td>
                <td class="px-6 py-4 text-gray-600 capitalize">{{ $member->gender }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($member->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('members.show', $member) }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                            <i class="fas fa-eye text-xs"></i>
                        </a>
                        <a href="{{ route('members.edit', $member) }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form method="POST" action="{{ route('members.destroy', $member) }}"
                              onsubmit="return confirm('Are you sure you want to delete this member?')">
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
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-users text-4xl mb-3 block" style="color: #FF6B35"></i>
                    No members found. <a href="{{ route('members.create') }}" style="color: #FF6B35" class="font-semibold hover:underline">Add one now!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t">
        {{ $members->links() }}
    </div>
</div>

@endsection