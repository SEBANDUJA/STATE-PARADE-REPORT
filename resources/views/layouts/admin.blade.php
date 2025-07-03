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

</head>
<body class="overflow-x-hidden bg-white">

    <div x-data="{ sidebarOpen: true }" class="flex h-screen relative">

    <!-- Sidebar -->
    <div
        id="sidebar"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="no-print fixed left-0 top-0 h-full bg-orange-500 text-white py-7 px-2 w-72 transform transition-transform duration-300 ease-in-out z-20"
    >

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
                        <!-- Upload Accordion -->
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
        <div
            id="main-content"
            :class="sidebarOpen ? 'ml-72' : 'ml-0'"
            class="flex-1 transition-all duration-300 ease-in-out"
        >

            <header
                :class="sidebarOpen ? 'ml-72' : 'ml-0'"
                class="transition-all duration-300 ease-in-out no-print bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 shadow-md p-4 flex items-center justify-between z-10 fixed right-0 left-0 top-0"
            >

                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-2xl text-black">
                        <i class="fas fa-bars cursor-pointer"></i>
                    </button>

                    <!-- <div class="text-2xl font-semibold text-black uppercase text-md">Dashboard</div> -->
                    <div class="text-2xl font-semibold text-black uppercase text-md">
                        @yield('page_title', 'Dashboard')
                    </div>

                </div>

                <div class="flex items-center space-x-12">
                    <div class="flex flex-row gap-x-5 justify-center items-center">

                        <div class="relative">
                            <button class="text-black">
                                <i class="fas fa-paper-plane text-2xl"></i>
                            </button>
                        </div>
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <!-- Clickable Bell Button -->
                            <button
                                @click="open = !open"
                                class="p-2 rounded-full hover:bg-gray-100 focus:outline-none"
                                aria-label="Notifications"
                            >
                                <i class="fas fa-bell text-2xl text-black"></i>
                            </button>

                            <!-- Dropdown -->
                            <div
                                x-show="open"
                                x-cloak
                                @click.stop
                                class="absolute right-0 mt-2 w-72 bg-white border border-gray-300 rounded-md shadow-lg z-50"
                            >
                                <div>
                                    <!-- Header -->
                                    <h3 class="font-semibold py-3 bg-black text-white px-4">Notifications</h3>

                                    <!-- Scrollable list with images, separators, and close icons -->
                                    <ul class="text-sm text-gray-600 divide-y divide-gray-200 overflow-y-auto max-h-60">
                                        <!-- Notification Item -->
                                        <li class="flex items-center justify-between gap-2 px-4 py-3 w-full">
                                            <div class="flex items-center gap-3">
                                                <img src="../images/wildfire.jpg" alt="Zimamoto Logo" class="rounded-full ring-1 ring-gray-400 w-8 h-8" />
                                                <span> New alert from HQ</span>
                                            </div>
                                            <button class="text-gray-400 hover:text-red-500">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </li>

                                        <li class="flex items-center justify-between gap-2 px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <img src="../images/artem.jpg" class="w-8 h-8 rounded-full" alt="icon" />
                                                <span> Daily incident report ready</span>
                                            </div>
                                            <button class="text-gray-400 hover:text-red-500">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </li>

                                        <li class="flex items-center justify-between gap-2 px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <img src="../images/pixabay.jpg" class="w-8 h-8 rounded-full" alt="icon" />
                                                <span> Fire drill at 3 PM</span>
                                            </div>
                                            <button class="text-gray-400 hover:text-red-500">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </li>

                                        <li class="flex items-center justify-between gap-2 px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <img src="../images/shvetsa.jpg" class="w-8 h-8 rounded-full" alt="icon" />
                                                <span> Another HQ alert</span>
                                            </div>
                                            <button class="text-gray-400 hover:text-red-500">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </li>
                                        <li class="flex items-center justify-between gap-2 px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <img src="../images/artem.jpg" class="w-8 h-8 rounded-full" alt="icon" />
                                                <span> My Recommendation</span>
                                            </div>
                                            <button class="text-gray-400 hover:text-red-500">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </li>
                                        <!-- Add more if needed -->
                                    </ul>

                                    <!-- Footer -->
                                    <span class="bg-black w-full p-2 flex justify-center items-center cursor-pointer hover:bg-gray-800">
                                        <i class="fas fa-plus text-md text-white px-3"></i>
                                        <span class="text-white text-sm">View All</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- person dropdown -->
                    <div class="relative">
                        <!-- User Menu Button -->
                        <button id="userMenuButton" class="text-black flex items-center space-x-2 focus:outline-none cursor-pointer">
                            <div class="relative">
                                <div class="w-10">
                                    <img src="{{ asset('images/wildfire.jpg') }}" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                </div>
                                <span class="absolute bottom-0 right-0 block w-3 h-3 rounded-full bg-green-500 border-2 border-white"></span>
                            </div>
                            <span class="font-semibold text-black text-sm">
                                {{ Auth::user()->username }}
                            </span>
                        </button>

                        <!-- Dropdown -->
                        <div id="userDropdown" class="hidden absolute right-0 top-full mt-2 w-fit bg-white border border-gray-200 rounded-md shadow-lg py-4 z-50">
                            <div class="flex flex-row justify-start items-center gap-x-6 w-full px-5">
                                <div class="w-16">
                                    <img src="{{ asset('images/wildfire.jpg') }}" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                </div>
                                <div class="flex flex-col justify-start items-start w-full">
                                    <span class="font-semibold text-black text-md">
                                        {{ Auth::user()->username }}
                                    </span>
                                    <span class="text-black text-xs">Chief Officer (C.O)</span>
                                </div>
                            </div>

                            <hr class="my-4 border-t-2 border-gray-400 w-full" />
                            
                            <div class="px-5 w-full">
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-user text-gray-500"></i> Profile Details
                                </a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-bell text-gray-500"></i> Notification
                                </a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100 w-full">
                                    <i class="fas fa-key text-gray-500"></i> Change Password
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 text-left py-2 text-md text-red-700 hover:bg-gray-100 cursor-pointer font-bold">
                                        <i class="fas fa-sign-out-alt text-red-700 font-bold"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6 text-black pt-20">
                @if (session('success'))
                    <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-400 alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('fail'))
                    <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-400">
                        {{ session('fail') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-400">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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

        // Notification icon
        document.addEventListener("DOMContentLoaded", function () {
            const bellButton = document.getElementById("bellButton");
            const notificationDropdown = document.getElementById("notificationDropdown");

            bellButton.addEventListener("click", function (e) {
                e.stopPropagation(); // Prevent clicking from closing it immediately
                notificationDropdown.classList.toggle("hidden");
            });

            // Hide dropdown when clicking outside
            document.addEventListener("click", function () {
                notificationDropdown.classList.add("hidden");
            });
        });
    </script>

</body>
</html>
