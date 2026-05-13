@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    {{-- Update Profile Info --}}
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-user-edit mr-2" style="color: #FF6B35"></i>Profile Information
        </h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('patch')

            {{-- Profile Photo --}}
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 rounded-full overflow-hidden border-4 flex items-center justify-center"
                     style="border-color: #FF6B35">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                             alt="Profile" class="w-full h-full object-cover" id="preview">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white text-2xl font-bold"
                             style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                            <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Profile Photo</label>
                    <input type="file" name="profile_photo" accept="image/*"
                        onchange="previewPhoto(this)"
                        class="text-sm text-gray-500 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG up to 2MB</p>
                </div>
            </div>

            @if(session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>Profile updated successfully!
            </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF6B35'"
                    onblur="this.style.borderColor='#e5e7eb'">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <input type="text" value="{{ ucfirst(auth()->user()->role) }}" disabled
                    class="w-full px-4 py-3 border-2 border-gray-100 rounded-lg bg-gray-50 text-gray-500">
            </div>

            <button type="submit"
                class="px-8 py-3 text-white font-bold rounded-lg shadow transition hover:opacity-90"
                style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                <i class="fas fa-save mr-2"></i>Save Changes
            </button>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white rounded-xl shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            <i class="fas fa-lock mr-2" style="color: #FF1493"></i>Change Password
        </h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('put')

            @if(session('status') === 'password-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>Password updated successfully!
            </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                <input type="password" name="current_password" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF1493'"
                    onblur="this.style.borderColor='#e5e7eb'">
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF1493'"
                    onblur="this.style.borderColor='#e5e7eb'">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#FF1493'"
                    onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <button type="submit"
                class="px-8 py-3 text-white font-bold rounded-lg shadow transition hover:opacity-90"
                style="background: linear-gradient(135deg, #FF1493, #FF6B35)">
                <i class="fas fa-key mr-2"></i>Update Password
            </button>
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="bg-white rounded-xl shadow-sm p-8 border-2 border-red-100">
        <h2 class="text-xl font-bold text-red-600 mb-2">
            <i class="fas fa-exclamation-triangle mr-2"></i>Delete Account
        </h2>
        <p class="text-gray-500 text-sm mb-6">Once deleted, all data will be permanently removed.</p>

        <form method="POST" action="{{ route('profile.destroy') }}"
              onsubmit="return confirm('Are you sure? This cannot be undone!')">
            @csrf
            @method('delete')

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Enter your password to confirm
                </label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border-2 border-red-200 rounded-lg focus:outline-none"
                    onfocus="this.style.borderColor='#ef4444'"
                    onblur="this.style.borderColor='#fecaca'">
            </div>

            <button type="submit"
                class="px-8 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition">
                <i class="fas fa-trash mr-2"></i>Delete Account
            </button>
        </form>
    </div>

</div>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            if (preview) {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
