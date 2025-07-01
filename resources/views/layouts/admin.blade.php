<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="bg-gray-100 overflow-x-hidden">

    <div x-data="{ sidebarCollapsed: false }" class="flex h-screen relative">

    <!-- Sidebar -->
    <div id="sidebar" class="no-print fixed left-0 top-0 h-full bg-orange-500 text-white py-7 px-2 w-72 transform transition-transform duration-300 ease-in-out">
        <div class="w-20 h-20 mx-24">
            <img src="{{ asset('images/Fire logo.png') }}" alt="Zimamoto Logo" class="w-full" />
        </div>
        <div class="w-full px-6 py-24">
            <ul class="flex flex-col gap-y-5 w-full uppercase text-xs">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                        <i class="fas fa-bell text-lg"></i> Dashboard
                    </a>
                </li>

                    <!-- Accordion 1 -->
                    <li>
                        <div class="relative">
                            <button class="flex justify-between gap-x-2 w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                <i class="fas fa-flag-checkered text-lg"></i>
                                State Parade Report
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-content hidden pl-4">
                                <a href="{{ route('reportbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-fire-alt text-xs mr-2"></i>Basic FireManShip</a>
                                <a href="{{ route('reportinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-cogs text-xs mr-2"></i>In Service</a>
                            </div>
                        </div>
                    </li>

                    <!-- Accordion 2 -->
                    <li>
                        <div class="relative">
                            <button class="flex justify-between gap-x-1 w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                <i class="fas fa-users text-lg"></i>
                                List of Students
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="accordion-content hidden pl-4">
                                <a href="{{ route('studentbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-user-graduate text-xs mr-2"></i>Basic FireManShip</a>
                                <a href="{{ route('studentinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-chalkboard-teacher text-xs mr-2"></i>In Service</a>
                            </div>
                        </div>
                    </li>

                    @if(Auth::user() && in_array(Auth::user()->role, ['admin', 'co', 'ci']))
                        <li>
                            <a href="{{ route('usermanager') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                                <i class="fas fa-user text-lg"></i> User Management
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('recommendation') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                                <i class="fas fa-bell text-lg"></i> Recommendation Area
                            </a>
                        </li>
                    @endif

                    @if(Auth::user() && in_array(Auth::user()->role, ['sm', 'hc']))
                        <li>
                            <div class="relative">
                                <button class="flex justify-between gap-x-1 w-full py-3 px-4 text-xs uppercase text-black bg-white border rounded-4xl focus:outline-none">
                                    <i class="fas fa-users text-lg"></i>
                                    Upload Parade Report
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="accordion-content hidden pl-4">
                                    <a href="{{ route('paradereportbasicfiremanship') }}" class="block py-3 text-xs text-black"><i class="fas fa-user-graduate text-xs mr-2"></i>Basic FireManShip</a>
                                    <a href="{{ route('paradereportinservice') }}" class="block py-3 text-xs text-black"><i class="fas fa-chalkboard-teacher text-xs mr-2"></i>In Service</a>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 ml-72 transition-all duration-500 ease-in-out">
        <header class="no-print bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 shadow-md p-4 flex items-center justify-between relative z-10">
            <div class="flex items-center space-x-4">
                <button id="toggleSidebar" class="text-2xl text-black">
                    <i class="fas fa-bars cursor-pointer"></i>
                </button>
                <div class="text-2xl font-semibold text-black uppercase text-md">Dashboard</div>
            </div>

                <div class="flex items-center space-x-12">
                    <div class="relative">
                        <button class="text-black relative">
                            <i class="fas fa-bell text-4xl"></i>
                            <span class="absolute top-0 right-0 block w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                        </button>
                    </div>

                    <div class="relative">
                        <button id="userMenuButton" class="text-black flex items-center space-x-2 focus:outline-none">
                            <div class="relative">
                                <div class="w-10">
                                    <img src="../images/wildfire.jpg" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                </div>
                                <span class="absolute bottom-0 right-0 block w-3 h-3 rounded-full bg-green-500 border-2 border-white"></span>
                            </div>
                            <span class="font-semibold text-black text-sm">
                                {{ Auth::user()->username }}
                            </span>
                        </button>

                        <div id="userDropdown" class="hidden absolute right-0 top-full mt-2 w-fit bg-white border border-gray-200 rounded-md shadow-lg py-4 z-50">
                            <div class="flex flex-row justify-start items-center gap-x-6 w-full px-5">
                                <div class="w-8">
                                    <img src="../images/wildfire.jpg" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                </div>
                                <div class="flex flex-col justify-start items-start">
                                    <span class="font-semibold text-black text-md">
                                    {{ Auth::user()->username }}
                                    </span>
                                    <span class="text-black text-xs">Chief Officer (C.O)</span>
                                </div>
                            </div>

                            <hr class="my-4 border-t-2 border-gray-400 w-full" />
                             
                            <div class="px-5">
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-user text-gray-500"></i>
                                    Profile Details
                                </a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-bell text-gray-500"></i>
                                    Notification
                                </a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-key text-gray-500"></i>
                                    Change Password
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 text-left py-2 text-sm text-red-700 hover:bg-gray-100 cursor-pointer">
                                        <i class="fas fa-sign-out-alt text-red-700"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6 text-black pt-20">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Sidebar & Dropdown Scripts -->
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        if (toggleButton) {
            toggleButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                mainContent.classList.toggle('ml-72');
            });
        }

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

        document.addEventListener("DOMContentLoaded", function() {
            const accordionButtons = document.querySelectorAll(".relative > button");

            accordionButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const content = button.nextElementSibling;

                    // Close all open contents
                    document.querySelectorAll(".accordion-content").forEach(c => {
                        if (c !== content) c.classList.add("hidden");
                    });

                    // Toggle the clicked one
                    content.classList.toggle("hidden");
                });
            });
        });
    </script>

</body>
</html>
