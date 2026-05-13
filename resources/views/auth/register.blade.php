<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShadexGym - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex">

    {{-- Left Side - Image --}}
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800&q=80&fit=crop"
             alt="Gym" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center p-12"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6))">
            <div class="text-center text-white">
                <i class="fas fa-dumbbell text-6xl mb-6"></i>
                <h1 class="text-4xl font-black mb-2">ShadexGym</h1>
                <p class="text-xl opacity-90 mb-8">Join Our Team</p>
                <div class="space-y-3 text-left">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        <span class="text-lg">Manage Members</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        <span class="text-lg">Track Attendance</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        <span class="text-lg">Record Payments</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Side - Register Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 overflow-y-auto">
        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl mb-4 shadow-lg"
                     style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-dumbbell text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-black text-gray-800">ShadexGym</h1>
                <p class="text-gray-500 mt-1" id="register-subtitle">Create your account</p>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="role" id="register_role" value="member">

                {{-- Role Selection --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-user-tag mr-2" style="color: #FF6B35"></i>Register As
                    </label>
                    <div class="flex rounded-xl overflow-hidden border-2 border-gray-100">
                        <button type="button" onclick="setRegisterRole('trainer')" id="reg-tab-trainer"
                            class="reg-tab flex-1 py-3 text-sm font-bold text-gray-500 transition flex items-center justify-center space-x-2 hover:bg-gray-50">
                            <i class="fas fa-user-tie mr-1"></i>
                            <span>Trainer</span>
                        </button>
                        <button type="button" onclick="setRegisterRole('member')" id="reg-tab-member"
                            class="reg-tab flex-1 py-3 text-sm font-bold text-gray-500 transition flex items-center justify-center space-x-2 hover:bg-gray-50">
                            <i class="fas fa-user mr-1"></i>
                            <span>Member</span>
                        </button>
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2" style="color: #FF6B35"></i>Full Name
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'"
                        placeholder="John Doe">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2" style="color: #FF6B35"></i>Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'"
                        placeholder="john@example.com">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2" style="color: #FF6B35"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition"
                            onfocus="this.style.borderColor='#FF6B35'"
                            onblur="this.style.borderColor='#e5e7eb'"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password', 'eye1')"
                            class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="eye1"></i>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2" style="color: #FF1493"></i>Confirm Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password2" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition"
                            onfocus="this.style.borderColor='#FF1493'"
                            onblur="this.style.borderColor='#e5e7eb'"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password2', 'eye2')"
                            class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>

                {{-- Register Button --}}
                <button type="submit"
                    class="w-full py-3 px-6 text-white font-bold rounded-lg transition transform hover:scale-105 shadow-lg"
                    style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span id="register-btn-text">Create Account</span>
                </button>

                {{-- Already have account --}}
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}"
                           class="font-bold hover:underline" style="color: #FF6B35">
                            Sign In
                        </a>
                    </p>
                </div>
            </form>

            <p class="text-center text-gray-400 text-xs mt-8">
                ShadexGym © {{ date('Y') }} — All rights reserved
            </p>
        </div>
    </div>

    <script>
        function setRegisterRole(role) {
            // Update hidden input
            document.getElementById('register_role').value = role;

            // Reset all tabs
            document.querySelectorAll('.reg-tab').forEach(tab => {
                tab.style.background = '';
                tab.style.color = '';
            });

            // Set active tab
            const activeTab = document.getElementById('reg-tab-' + role);
            activeTab.style.background = 'linear-gradient(135deg, #FF6B35, #FF1493)';
            activeTab.style.color = 'white';

            // Update subtitle and button text
            if (role === 'trainer') {
                document.getElementById('register-subtitle').textContent = 'Create your Trainer account';
                document.getElementById('register-btn-text').textContent = 'Register as Trainer';
            } else {
                document.getElementById('register-subtitle').textContent = 'Create your Member account';
                document.getElementById('register-btn-text').textContent = 'Register as Member';
            }
        }

        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Set default on page load
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('role') === 'trainer') {
                setRegisterRole('trainer');
            } else {
                setRegisterRole('member');
            }
        }
    </script>
</body>
</html>
