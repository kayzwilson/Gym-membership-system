<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B35',
                        secondary: '#FF1493',
                        accent: '#22C55E',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    {{-- Sidebar --}}
    <div class="flex h-screen overflow-hidden">
        <div class="w-64 bg-white shadow-lg flex flex-col" style="background: linear-gradient(180deg, #FF6B35 0%, #FF1493 100%);">
            
            {{-- Logo --}}
            <div class="p-6 text-center border-b border-white border-opacity-30">
                <div class="text-white text-2xl font-bold">
                    <i class="fas fa-dumbbell mr-2"></i>
                    GymPro
                </div>
                <p class="text-white text-opacity-80 text-xs mt-1">Membership System</p>
            </div>

            {{-- User Info --}}
            <div class="p-4 border-b border-white border-opacity-30">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
                        <i class="fas fa-user text-orange-500"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-white text-opacity-70 text-xs capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-20' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('members.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('members.*') ? 'bg-white bg-opacity-20' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Members</span>
                </a>

                <a href="{{ route('membership_plans.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('membership_plans.*') ? 'bg-white bg-opacity-20' : '' }}">
                    <i class="fas fa-clipboard-list w-5"></i>
                    <span>Membership Plans</span>
                </a>

                <a href="{{ route('payments.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('payments.*') ? 'bg-white bg-opacity-20' : '' }}">
                    <i class="fas fa-credit-card w-5"></i>
                    <span>Payments</span>
                </a>

                <a href="{{ route('attendance.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('attendance.*') ? 'bg-white bg-opacity-20' : '' }}">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span>Attendance</span>
                </a>

                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('profile.*') ? 'bg-white bg-opacity-20' : '' }}">
                    <i class="fas fa-user-cog w-5"></i>
                    <span>Profile</span>
                </a>
            </nav>

            {{-- Logout --}}
            <div class="p-4 border-t border-white border-opacity-30">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            
            {{-- Top Bar --}}
            <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-800">@yield('title')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ now()->format('D, d M Y') }}</span>
                    <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                        <i class="fas fa-user text-white text-xs"></i>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-6 pt-4">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                        <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                        <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
            </div>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>