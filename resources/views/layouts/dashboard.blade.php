<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true, sidebarCollapsed: false }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>
    <title>Taguig Yakap Center</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-[#ff5147] text-gray-800">
    <div class="fixed inset-0 z-20 bg-black/50 bg-opacity-50 transition-opacity lg:hidden"
        :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false">
    </div>

    <div class="flex h-screen overflow-hidden">
        <aside
            class="fixed inset-y-0 left-0 z-30 transform transition-transform duration-200 ease-in-out flex flex-col bg-[#ff5147] lg:bg-[#ff5147]"
            :class="{'-translate-x-full': !sidebarOpen, 'w-18': sidebarCollapsed, 'w-64': !sidebarCollapsed}">

            <div
                class="block m-3 flex items-center justify-center h-16 rounded hover:bg-[#F4C027] hover:text-black text-white">
                <span x-show="!sidebarCollapsed" x-cloak class="flex items-center">
                    <img src="{{ asset('images/logoyakap.jpg') }}" alt="" class="w-10 mr-2">
                    Taguig Yakap Center
                </span>
                <span x-show="sidebarCollapsed" x-cloak class="font-bold text-xl">
                    <img src="{{ asset('images/logoyakap.webp') }}" alt="" class="w-10">
                </span>
            </div>

            <nav class="p-4 space-y-2 overflow-auto no-scrollbar">
                <!-- home -->
                <div class="flex items-center gap-4">
                    <span x-show="!sidebarCollapsed" x-cloak class="text-sm font-semibold text-white">Home</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-minus text-white"></i></span>
                </div>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-table-columns me-2"></i> Dashboard</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-table-columns"></i></span>
                </a>
                <!-- student -->
                <div class="flex items-center gap-4 mt-5">
                    <span x-show="!sidebarCollapsed" x-cloak class="text-sm font-semibold text-white">Student</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-minus text-white"></i></span>
                </div>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-hands-holding-child me-2"></i>
                        Children profile</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-hands-holding-child"></i></span>
                </a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-list-check me-2"></i>
                        Progress report</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-list-check"></i>
                </a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i class="fa-solid fa-book me-2"></i>
                        Educational plan</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-book"></i>
                </a>
                <!-- enrollment -->
                <div class="flex items-center gap-4 mt-5">
                    <span x-show="!sidebarCollapsed" x-cloak class="text-sm font-semibold text-white">Enrollment</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-minus text-white"></i></span>
                </div>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-folder-open me-2"></i>
                        Enrollment</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-folder-open"></i></span>
                </a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-paperclip me-2"></i>
                        Requirements</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-paperclip"></i></span>
                </a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-clipboard-user me-2"></i>
                        Therapy</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-clipboard-user"></i></span>
                </a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-file-contract me-2"></i>
                        Consent form</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-file-contract"></i></span>
                </a>
                @role('superadmin|admin')
                <!-- Cms -->
                <div class="flex items-center gap-4 mt-5">
                    <span x-show="!sidebarCollapsed" x-cloak class="text-sm font-semibold text-white">Cms</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium">
                        <i class="fa-solid fa-minus text-white"></i>
                    </span>
                </div>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.allergy.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-hand-dots me-2"></i>
                        Allergy</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-hand-dots"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.blood.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-droplet me-2"></i>
                        Blood type</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-droplet"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.civil.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i class="fa-solid fa-heart me-2"></i>
                        Civil status</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-heart"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.disability.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-wheelchair me-2"></i>
                        Disability</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-wheelchair"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.district.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-building-columns me-2"></i>
                        District</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-building-columns"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.barangay.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-building-user me-2"></i>
                        Barangay</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-building-user"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.education.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i class="fa-solid fa-school me-2"></i>
                        Education</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-school"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.gender.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-venus-mars me-2"></i>
                        Gender</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-venus-mars"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.goal.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-flag-checkered me-2"></i>
                        Goal</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-flag-checkered"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.competency.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-graduation-cap me-2"></i>
                        Learning Competency</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-graduation-cap"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.domain.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-book-open me-2"></i>
                        Learning Domain</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-book-open"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.objective.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-bullseye me-2"></i>
                        Objective</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-bullseye"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.parent.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-user-friends me-2"></i>
                        Parent type</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-user-friends"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.privacy.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-lock me-2"></i>
                        Privacy</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-lock"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.program.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-laptop-code me-2"></i>
                        Program</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-laptop-code"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.rating.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-star me-2"></i>
                        Rating</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-star"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.relation.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-sitemap me-2"></i>
                        Relation</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-sitemap"></i></span>
                </a>
                <a href="{{ route(Auth::user()->getRoleNames()->first() . '.service.index')  }}" class="block py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition">
                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                            class="fa-solid fa-hands-helping me-2"></i>
                        Service</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full h-full font-medium"><i
                            class="fa-solid fa-hands-helping"></i></span>
                </a>
                @endrole
            </nav>
            <div class="mt-auto p-4 border-gray-200" x-data="{ userDropdownOpen: false }">
                <div class="relative">
                    <button @click="userDropdownOpen = !userDropdownOpen"
                        class="w-full flex items-center justify-between py-2 px-3 rounded hover:bg-[#F4C027] hover:text-black text-white transition focus:outline-none">
                        <span x-show="!sidebarCollapsed" x-cloak class="text-xs font-medium uppercase">
                            @auth
                            {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                            {{ Auth::user()->last_name }}
                            @endauth
                        </span>
                        <span x-show="sidebarCollapsed" x-cloak class="font-medium">
                            @auth
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{  strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                            @endauth
                        </span>
                        <svg x-show="!sidebarCollapsed" x-cloak class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7" />
                        </svg>
                    </button>
                    <div x-show="userDropdownOpen" x-cloak x-transition
                        class="absolute left-0 bottom-full mb-2 w-full bg-white shadow-md rounded z-10">
                        <a href="#" class="block py-2 px-3 hover:bg-[#F4C027] hover:text-black text-black transition">
                            <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                                    class="fa-solid fa-user-tie me-2"></i> Role</span>
                            <span x-show="sidebarCollapsed" x-cloak class="font-medium"><i
                                    class="fa-solid fa-user-tie"></i></span>
                        </a>
                        <a href="#" class="block py-2 px-3 hover:bg-[#F4C027] hover:text-black text-black transition">
                            <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                                    class="fa-solid fa-lock me-2"></i> Permission</span>
                            <span x-show="sidebarCollapsed" x-cloak class="font-medium"><i
                                    class="fa-solid fa-lock"></i></span>
                        </a>
                        <a href="#" class="block py-2 px-3 hover:bg-[#F4C027] hover:text-black text-black transition">
                            <span x-show="!sidebarCollapsed" x-cloak class="font-medium"><i
                                    class="fa-solid fa-user me-2"></i> Profile</span>
                            <span x-show="sidebarCollapsed" x-cloak class="font-medium"><i
                                    class="fa-solid fa-user"></i></span>
                        </a>
                        <form action="#" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left py-2 px-3 hover:bg-[#F4C027] hover:text-black text-black transition focus:outline-none">
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                </span>
                                <span x-show="sidebarCollapsed" x-cloak class="font-medium">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col transition-all duration-200"
            :class="sidebarCollapsed ? 'lg:ml-18' : 'lg:ml-64'">
            <div class="bg-white flex-1 shadow-lg rounded-lg p-6 m-3">
                <nav class="mb-3">
                    @hasSection('breadcrumb')
                    @yield('breadcrumb')
                    @endif
                </nav>
                <main class="p-5 overflow-y-auto">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>

</html>