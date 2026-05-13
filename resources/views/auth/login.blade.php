<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShadexGym - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .slide { display: none; }
        .slide.active { display: block; }
        .role-tab.active {
            background: linear-gradient(135deg, #FF6B35, #FF1493);
            color: white;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.5s ease forwards; }
    </style>
</head>
<body class="min-h-screen flex">

    {{-- Left Side - Slideshow --}}
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        
        {{-- Slides --}}
        <div class="slide active absolute inset-0">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&q=80&fit=crop" 
     alt="Gym" class="w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.5))">
                <div class="flex flex-col items-center justify-center h-full text-white text-center p-12">
                    <i class="fas fa-dumbbell text-6xl mb-4"></i>
                    <h2 class="text-3xl font-bold mb-2">Transform Your Body</h2>
                    <p class="text-lg opacity-90">Join thousands of members achieving their fitness goals</p>
                </div>
            </div>
        </div>

        <div class="slide absolute inset-0">
            <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800&q=80&fit=crop" 
     alt="Gym" class="w-full h-full object-cover">
            <<div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.5))">
                <div class="flex flex-col items-center justify-center h-full text-white text-center p-12">
                    <i class="fas fa-heartbeat text-6xl mb-4"></i>
                    <h2 class="text-3xl font-bold mb-2">Track Your Progress</h2>
                    <p class="text-lg opacity-90">Monitor attendance, payments and membership plans</p>
                </div>
            </div>
        </div>

        <div class="slide absolute inset-0">
            <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800&q=80&fit=crop" 
     alt="Gym" class="w-full h-full object-cover">
            <<div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.5))">
                <div class="flex flex-col items-center justify-center h-full text-white text-center p-12">
                    <i class="fas fa-trophy text-6xl mb-4"></i>
                    <h2 class="text-3xl font-bold mb-2">Achieve Your Goals</h2>
                    <p class="text-lg opacity-90">Professional management for your fitness journey</p>
                </div>
            </div>
        </div>

        <div class="slide absolute inset-0">
            <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=800&q=80&fit=crop" 
     alt="Gym" class="w-full h-full object-cover">
            <<div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.5))">
                <div class="flex flex-col items-center justify-center h-full text-white text-center p-12">
                    <i class="fas fa-users text-6xl mb-4"></i>
                    <h2 class="text-3xl font-bold mb-2">Join Our Community</h2>
                    <p class="text-lg opacity-90">Be part of a growing fitness family</p>
                </div>
            </div>
        </div>

        {{-- Slide Dots --}}
        <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2">
            <button onclick="goToSlide(0)" class="dot w-3 h-3 rounded-full bg-white opacity-100 transition"></button>
            <button onclick="goToSlide(1)" class="dot w-3 h-3 rounded-full bg-white opacity-50 transition"></button>
            <button onclick="goToSlide(2)" class="dot w-3 h-3 rounded-full bg-white opacity-50 transition"></button>
            <button onclick="goToSlide(3)" class="dot w-3 h-3 rounded-full bg-white opacity-50 transition"></button>
        </div>
    </div>

    {{-- Right Side - Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 overflow-y-auto">
        <div class="w-full max-w-md">

            {{-- Logo --}}
          {{-- Logo --}}
<div class="text-center mb-8">
    <img src="{{ asset('images/logo.svg') }}" alt="ShadexGym" class="h-14 mx-auto mb-3">
    <p class="text-gray-500 mt-1">Membership Management System</p>
</div>

            {{-- Role Tabs --}}
            <div class="flex rounded-xl overflow-hidden border-2 border-gray-100 mb-8">
                <button onclick="selectRole('admin')" id="tab-admin"
                    class="role-tab active flex-1 py-3 text-sm font-bold transition flex items-center justify-center space-x-2">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin</span>
                </button>
                <button onclick="selectRole('trainer')" id="tab-trainer"
                    class="role-tab flex-1 py-3 text-sm font-bold text-gray-500 transition flex items-center justify-center space-x-2">
                    <i class="fas fa-user-tie"></i>
                    <span>Trainer</span>
                </button>
                <button onclick="selectRole('member')" id="tab-member"
                    class="role-tab flex-1 py-3 text-sm font-bold text-gray-500 transition flex items-center justify-center space-x-2">
                    <i class="fas fa-user"></i>
                    <span>Member</span>
                </button>
            </div>

            {{-- Role Description --}}
            <div id="role-desc" class="text-center mb-6 p-3 rounded-lg bg-orange-50">
                <p class="text-sm font-semibold" style="color: #FF6B35">
                    <i class="fas fa-user-shield mr-2"></i>
                    <span id="role-desc-text">Login as Administrator — Full system access</span>
                </p>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="role_selected" id="role_selected" value="admin">

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2" style="color: #FF6B35"></i>Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'"
                        placeholder="Enter your email">
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
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded" style="accent-color: #FF6B35">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-semibold hover:underline"
                        style="color: #FF6B35">Forgot password?</a>
                    @endif
                </div>

                {{-- Register / Help --}}
<div id="member-help" class="hidden text-center mt-4 p-4 bg-orange-50 rounded-lg">
    <p class="text-sm text-gray-600">
        <i class="fas fa-info-circle mr-1" style="color: #FF6B35"></i>
        Don't have an account? Contact your gym admin to register you.
    </p>
</div>

<div id="register-link" class="hidden text-center mt-4">
    <p class="text-sm text-gray-600">
        New trainer member? 
       <a href="{{ route('register') }}?role=trainer" 
   class="font-bold hover:underline" style="color: #FF6B35">
    Create Account
</a>
    </p>
</div>

                {{-- Login Button --}}
                <button type="submit" id="login-btn"
                    class="w-full py-3 px-6 text-white font-bold rounded-lg transition transform hover:scale-105 shadow-lg"
                    style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span id="btn-text">Sign In as Admin</span>
                </button>
            </form>

            <p class="text-center text-gray-400 text-xs mt-8">
                ShadexGym © {{ date('Y') }} — All rights reserved
            </p>
        </div>
    </div>

    <script>
        // Slideshow
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function goToSlide(n) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].style.opacity = '0.5';
            currentSlide = n;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].style.opacity = '1';
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        setInterval(nextSlide, 4000);

        // Role Tabs
        const roles = {
            admin: {
                desc: 'Login as Administrator — Full system access',
                icon: 'fa-user-shield',
                btn: 'Sign In as Admin'
            },
            trainer: {
                desc: 'Login as Trainer — Manage members and attendance',
                icon: 'fa-user-tie',
                btn: 'Sign In as Trainer'
            },
            member: {
                desc: 'Login as Member — View your profile and attendance',
                icon: 'fa-user',
                btn: 'Sign In as Member'
            }
        };

       function selectRole(role) {
    // Update tabs
    document.querySelectorAll('.role-tab').forEach(tab => {
        tab.classList.remove('active');
        tab.classList.add('text-gray-500');
    });
    document.getElementById('tab-' + role).classList.add('active');
    document.getElementById('tab-' + role).classList.remove('text-gray-500');

    // Update description
    document.getElementById('role-desc-text').innerHTML =
        '<i class="fas ' + roles[role].icon + ' mr-2"></i>' + roles[role].desc;

    // Update button
    document.getElementById('btn-text').textContent = roles[role].btn;

    // Update hidden input
    document.getElementById('role_selected').value = role;

    // Show/hide help sections
    document.getElementById('member-help').classList.add('hidden');
    document.getElementById('register-link').classList.add('hidden');

    if (role === 'member') {
        document.getElementById('member-help').classList.remove('hidden');
    } else if (role === 'trainer') {
        document.getElementById('register-link').classList.remove('hidden');
    }
}

        // Password toggle
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
