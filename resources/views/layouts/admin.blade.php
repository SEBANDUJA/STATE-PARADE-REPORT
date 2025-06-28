<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">

    <div class="flex pt-20 transition-all duration-300">
        <!-- Sidebar -->
            <div id="sidebar" class="fixed top-0 left-0 h-full w-72 bg-orange-500 text-white z-50 flex flex-col transition-all duration-300">
            <!-- Logo Area -->
            <div class="flex-shrink-0 py-6">
                <div class="w-32 h-32 mx-auto flex items-center justify-center">
                    <img src="{{ asset('images/Fire logo.png') }}" alt="Zimamoto Logo" class="h-full object-contain" loading="lazy" />
                </div>
            </div>


            <!-- Scrollable menu: Add class 'scrollable-content' -->
            <div class="flex-grow overflow-y-auto px-6 py-6 h-screen">
                <ul class="flex flex-col gap-y-4 uppercase text-xs">

                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                            <i class="fas fa-bell text-lg"></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Accordion 1 with Icon -->
                    <li>
                        <div class="relative">
                            <button id="accordion1" class="flex flex-row justify-between gap-x-2 block w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                <i class="fas fa-flag-checkered text-lg"></i>
                                State Parade Report
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="accordion1-content" class="accordion-content hidden pl-4">
                                <a href="{{ route('reportbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-fire-alt text-xs mr-2"></i>Basic FireManShip</a>
                                <a href="{{ route('reportinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-cogs text-xs mr-2"></i>In Service</a>
                            </div>
                        </div>
                    </li>

                    <!-- Accordion 2 with Icon -->
                    <li>
                        <div class="relative">
                            <button id="accordion2" class="flex flex-row justify-between gap-x-1 block w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                <i class="fas fa-users text-lg"></i> <!-- Icon for List of Students -->
                                List of Students
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="accordion2-content" class="accordion-content hidden pl-4">
                                <a href="{{ route('studentbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-user-graduate text-xs mr-2"></i>Basic FireManShip</a>
                                <a href="{{ route('studentinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-chalkboard-teacher text-xs mr-2"></i>In Service</a>
                            </div>
                        </div>
                    </li>

                    <!-- User management -->
                    <li>
                        <a href="{{ route('usermanager') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                            <i class="fas fa-user text-lg"></i> <!-- Icon for User management -->
                            User management
                        </a>
                    </li>

                    <!-- Recommendation Area with Icon -->
                    <li>
                        <a href="{{ route('recommendation') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                            <i class="fas fa-bell text-lg"></i>
                            Recommendation Area
                        </a>
                    </li>

                    <!-- Accordion 3 with Icon -->
                    <li>
                        <div class="relative">
                            <button id="accordion3" class="flex flex-row justify-between gap-x-1 block w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                <i class="fas fa-users text-lg"></i> <!-- Icon for List of Students -->
                                Upload parade report
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="accordion3-content" class="accordion-content hidden pl-4">
                                <a href="{{ route('paradereportbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-user-graduate text-xs mr-2"></i>Basic FireManShip</a>
                                <a href="{{ route('paradereportinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-chalkboard-teacher text-xs mr-2"></i>In Service</a>
                            </div>
                        </div>
                    </li>
                        
                    <!-- Settings with Icon -->
                    <li>
                        <div class="relative">
                            <button id="accordion4" class="flex flex-row justify-between gap-x-1 block w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                <i class="fas fa-cog text-lg"></i> <!-- Icon for List of Students -->
                                System Settings
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div id="accordion4-content" class="accordion-content hidden pl-4">
                                <a href="{{ route('paradereportbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-user-graduate text-xs mr-2"></i>Season Registry</a>
                                <a href="{{ route('paradereportinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-chalkboard-teacher text-xs mr-2"></i>Course Registry</a>
                                <a href="{{ route('paradereportinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-chalkboard-teacher text-xs mr-2"></i>Course Registry</a>
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="ml-72 w-[calc(100%-18rem)] transition-all duration-300">

            <!-- header -->
            <header id="mainHeader" class="fixed top-0 left-72 right-0 h-16 bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 shadow-md z-30 transition-all duration-300 flex justify-between items-center px-4">
                <div class="flex items-center space-x-4">
                    <!-- Toggle Button for Sidebar -->
                    <button id="toggleSidebar" class="text-2xl text-black">
                        <i class="fas fa-bars cursor-pointer"></i>
                    </button>

                    <!-- dynamic dashboard head -->
                    <div class="text-2xl font-semibold text-black uppercase font-thin text-md">
                        @php
                            $path = request()->path();

                            $pageTitle = match (true) {
                                str_contains($path, 'dashboard') => 'Home Dashboard',
                                str_contains($path, 'reportbasicfiremanship') => 'basic firemanship state parade Report',
                                str_contains($path, 'reportinservice') => 'in_service state parade report',
                                str_contains($path, 'paradereportbasicfiremanship') => 'basic firemanship upload parade report',
                                str_contains($path, 'paradereportinservice') => 'in_service upload parade report',
                                str_contains($path, 'studentbasicfiremanship') => 'basic firemanship student list',
                                str_contains($path, 'studentinservice') => 'in_service student list',
                                str_contains($path, 'usermanagement') => 'user management',
                                str_contains($path, 'recommendation') => 'Recommendation',
                                str_contains($path, 'settings') => 'Settings',
                                default => 'Page'
                            };
                        @endphp

                        {{ $pageTitle }}
                    </div>

                </div>

                <div class="flex items-center space-x-12">
                    <!-- Notification Icon with Badge -->
                    <div class="relative">
                        <button class="text-black relative">
                            <i class="fas fa-bell text-4xl"></i>
                            <span class="absolute top-0 right-0 block w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                        </button>
                    </div>

                    <!-- Person Icon with Dropdown and Name -->
                    <div class="relative">
                        <button id="userMenuButton" class="text-black flex items-center space-x-2 focus:outline-none">
                            <!-- Icon with badge -->
                            <div class="relative">
                                <i class="fas fa-user-circle text-4xl"></i>
                                <!-- Green online badge -->
                                <span class="absolute bottom-0 right-0 block w-3 h-3 rounded-full bg-green-500 border-2 border-white"></span>
                            </div>

                            <span class="font-semibold text-black text-sm">
                                {{ Auth::user() ? Auth::user()->username : 'Guest' }}
                            </span>
                        </button>

                        <!-- Dropdown positioned below the icon -->
                        <div id="userDropdown" class="hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg py-2 z-50">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>


            <!-- Dynamic Page Content -->
            <div class="py-6 text-black">
                @yield('content')
            </div>

        </div>
    </div>

    <!-- Sidebar & Dropdown Scripts -->
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const header = document.getElementById('mainHeader');

        let sidebarOpen = true;

        toggleButton.addEventListener('click', () => {
            if (sidebarOpen) {
                // Close sidebar: hide sidebar & shrink margins
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-72');
                mainContent.classList.add('ml-0');
                header.classList.remove('left-72');
                header.classList.add('left-0');
            } else {
                // Open sidebar: show sidebar & expand margins
                sidebar.classList.remove('-translate-x-full');
                mainContent.classList.remove('ml-16');
                mainContent.classList.add('ml-72');
                header.classList.remove('left-16');
                header.classList.add('left-72');
            }
            sidebarOpen = !sidebarOpen;
        });


        function toggleAccordion(targetId) {
            const allAccordions = document.querySelectorAll('.accordion-content');
            const targetContent = document.getElementById(targetId);
            allAccordions.forEach(content => {
                if (content !== targetContent) {
                    content.classList.add('hidden');
                }
            });
            if (targetContent) {
                targetContent.classList.toggle('hidden');
            }
        }

        document.getElementById("accordion1").addEventListener("click", () => toggleAccordion("accordion1-content"));
        document.getElementById("accordion2").addEventListener("click", () => toggleAccordion("accordion2-content"));
        document.getElementById("accordion3").addEventListener("click", () => toggleAccordion("accordion3-content"));
        document.getElementById("accordion4").addEventListener("click", () => toggleAccordion("accordion4-content"));

        const userButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');

        document.addEventListener('click', function (e) {
            if (userButton && userButton.contains(e.target)) {
                userDropdown.classList.toggle('hidden');
            } else if (userDropdown && !userDropdown.contains(e.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
