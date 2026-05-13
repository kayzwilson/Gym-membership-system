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
    <style>
        /* Sidebar Scrollbar */
        nav::-webkit-scrollbar {
            width: 4px;
        }
        nav::-webkit-scrollbar-track {
            background: transparent;
        }
        nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
        nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }

        /* General Page Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(#FF6B35, #FF1493);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(#FF1493, #FF6B35);
        }

        /* Smooth transitions */
        * {
            transition: border-color 0.2s ease;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    {{-- Sidebar --}}
    <div class="flex h-screen overflow-hidden">
        <div class="w-64 bg-white shadow-lg flex flex-col" style="background: linear-gradient(180deg, #FF6B35 0%, #FF1493 100%);">
            
          {{-- Logo --}}
{{-- Logo --}}
<div class="p-6 text-center border-b border-white border-opacity-30" style="background: rgba(0,0,0,0.3)">
    <div class="flex items-center justify-center space-x-3">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg"
             style="background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.5)">
            <i class="fas fa-dumbbell text-white text-xl"></i>
        </div>
        <div class="text-left">
            <h1 class="text-white font-black text-xl tracking-wide">Shadex<span style="color: #FFD700">Gym</span></h1>
            <div class="flex items-center space-x-1 mt-0.5">
                <div class="w-2 h-2 rounded-full bg-green-400"></div>
                <p class="text-white text-opacity-80 text-xs">System Online</p>
            </div>
        </div>
    </div>
    <div class="mt-4 px-3 py-2 rounded-lg" style="background: rgba(255,255,255,0.15)">
        <p class="text-white text-opacity-90 text-xs font-semibold tracking-widest uppercase">
            Membership Management
        </p>
    </div>
</div>

            {{-- User Info --}}
<div class="p-4 border-b border-white border-opacity-30">
    <div class="flex items-center space-x-3">
        <div class="relative">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                     alt="Profile"
                     class="w-12 h-12 rounded-full object-cover border-2 border-white">
            @else
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center">
                    <span class="font-bold text-lg" style="color: #FF6B35">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
            @endif
        </div>
        <div>
            <p class="text-white font-bold text-sm">{{ auth()->user()->name }}</p>
            <p class="text-white text-opacity-70 text-xs capitalize">{{ auth()->user()->role }}</p>
        </div>
    </div>
</div>

            {{-- Navigation --}}
<nav class="flex-1 p-4 space-y-2 overflow-y-auto">
    <a href="{{ route('dashboard') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-tachometer-alt w-5"></i>
        <span>Dashboard</span>
    </a>

    @if(auth()->user()->isAdmin() || auth()->user()->isTrainer())
    <a href="{{ route('members.index') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('members.*') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-users w-5"></i>
        <span>Members</span>
    </a>
    @endif

    @if(auth()->user()->isAdmin())
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

    <a href="{{ route('reports.index') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('reports.*') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-chart-bar w-5"></i>
        <span>Reports</span>
    </a>
    @endif

    @if(auth()->user()->isAdmin() || auth()->user()->isTrainer())
    <a href="{{ route('attendance.index') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('attendance.*') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-calendar-check w-5"></i>
        <span>Attendance</span>
    </a>

    <a href="{{ route('workout_plans.index') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('workout_plans.*') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-dumbbell w-5"></i>
        <span>Workout Plans</span>
    </a>

    <a href="{{ route('training_sessions.index') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('training_sessions.*') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-stopwatch w-5"></i>
        <span>Training Sessions</span>
    </a>
    @endif

    {{-- Notifications for all --}}
    <a href="{{ route('notifications.index') }}"
       class="flex items-center space-x-3 p-3 rounded-lg text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('notifications.*') ? 'bg-white bg-opacity-20' : '' }}">
        <i class="fas fa-bell w-5"></i>
        <span>Notifications</span>
        @if(isset($unreadNotifications) && $unreadNotifications > 0)
        <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
            {{ $unreadNotifications }}
        </span>
        @endif
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
