<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen flex">

    {{-- Left Side - Image --}}
    <div class="hidden lg:flex lg:w-1/2 relative">
        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800" 
             alt="Gym" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center p-12"
             style="background: linear-gradient(135deg, rgba(255,107,53,0.85) 0%, rgba(255,20,147,0.85) 100%)">
            <div class="text-center text-white">
                <i class="fas fa-dumbbell text-6xl mb-6"></i>
                <h1 class="text-4xl font-bold mb-4">GymPro</h1>
                <p class="text-xl text-white text-opacity-90 mb-6">Membership Management System</p>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-300 text-xl"></i>
                        <span class="text-lg">Manage Members Easily</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-300 text-xl"></i>
                        <span class="text-lg">Track Attendance</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-300 text-xl"></i>
                        <span class="text-lg">Manage Payments</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-300 text-xl"></i>
                        <span class="text-lg">Membership Plans</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Side - Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8">
        <div class="w-full max-w-md">
            
            {{-- Logo for mobile --}}
            <div class="lg:hidden text-center mb-8">
                <i class="fas fa-dumbbell text-4xl" style="color: #FF6B35"></i>
                <h1 class="text-2xl font-bold mt-2" style="color: #FF6B35">GymPro</h1>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Welcome Back!</h2>
                <p class="text-gray-500 mt-2">Sign in to your account</p>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2" style="color: #FF6B35"></i>Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none transition"
                        style="focus:border-color: #FF6B35"
                        onfocus="this.style.borderColor='#FF6B35'"
                        onblur="this.style.borderColor='#e5e7eb'"
                        placeholder="admin@gym.com">
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

                {{-- Login Button --}}
                <button type="submit"
                    class="w-full py-3 px-6 text-white font-bold rounded-lg transition transform hover:scale-105 shadow-lg"
                    style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </button>
            </form>

            <p class="text-center text-gray-500 text-sm mt-8">
                GymPro © {{ date('Y') }} — All rights reserved
            </p>
        </div>
    </div>

    <script>
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