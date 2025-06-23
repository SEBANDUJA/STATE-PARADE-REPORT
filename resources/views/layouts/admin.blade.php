<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @vite('resources/js/app.js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> -->

</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div id="sidebar" class="fixed left-0 top-0 h-full bg-orange-500 text-white py-7 px-2 w-72 transform transition-transform duration-300 ease-in-out ">
        <div class="w-20 h-20 mx-24">
            <img src="{{ asset('images/Fire logo.png') }}" alt="Zimamoto Logo" class="w-full" />
        </div>
        <div class="w-full px-6 py-24">
            <ul class="flex flex-col gap-y-5 w-full uppercase text-xs">
                

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
                    <a href="{{ route('usermanagement') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
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
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 ml-72 transition-all duration-300 ease-in-out">
         <header class="bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 shadow-md p-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- Toggle Button for Sidebar -->
                <button id="toggleSidebar" class="text-2xl text-black">
                    <i class="fas fa-bars cursor-pointer"></i> <!-- Hamburger Icon -->
                </button>
                <div class="text-2xl font-semibold text-black uppercase font-thin text-md">Dashboard</div>
            </div>

            <div class="flex items-center space-x-12">
                <!-- Notification Icon with Badge -->
                <div class="relative">
                    <button class="text-gray-600 relative">
                        <i class="fas fa-bell text-4xl"></i>
                        <!-- Notification Badge -->
                        <span class="absolute top-0 right-0 block w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                    </button>
                </div>

                <!-- Person Icon with Logout -->
                <div class="flex items-center space-x-2">
                    <button class="text-gray-500">
                        <i class="fas fa-user-circle text-4xl"></i> <!-- Person Icon -->
                    </button>
                </div>
            </div>
        </header>

        <!-- Dynamic Page Content -->
        <div class="p-6 text-black">
            @yield('content')
        </div>
    </div>

    <!-- Sidebar Toggle and Accordion Scripts -->
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        let isSidebarOpen = true;

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mainContent.classList.toggle('ml-72');
            isSidebarOpen = !isSidebarOpen;
        });

        function toggleAccordion(targetId) {
            const allAccordions = document.querySelectorAll('.accordion-content');
            const targetContent = document.getElementById(targetId);
            allAccordions.forEach(content => {
                if (content !== targetContent) {
                    content.classList.add('hidden');
                }
            });
            targetContent.classList.toggle('hidden');
        }

        document.getElementById("accordion1").addEventListener("click", () => toggleAccordion("accordion1-content"));
        document.getElementById("accordion2").addEventListener("click", () => toggleAccordion("accordion2-content"));
    </script>

</body>
</html>
