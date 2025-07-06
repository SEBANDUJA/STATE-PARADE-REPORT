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
                                <i class="fas fa-address-book text-lg"></i>
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
                                    <i class="fas fa-file-upload text-lg"></i>
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
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-x-4 py-3 px-4 text-black bg-white rounded-4xl text-start">
                                <i class="fas fa-chart-bar text-lg"></i> Statistics
                            </a>
                        </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div
            id="main-content"
            :class="sidebarOpen ? 'ml-72' : 'ml-0'"
            class="flex-1 transition-all duration-300 ease-in-out"
        >

            <!-- Header -->
            <header
                :class="sidebarOpen ? 'ml-72' : 'ml-0'"
                class="transition-all duration-300 ease-in-out no-print bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 shadow-md p-4 flex items-center justify-between z-10 fixed right-0 left-0 top-0"
            >

                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-2xl text-black">
                        <i class="fas fa-bars cursor-pointer"></i>
                    </button>

                    <div class="text-2xl font-semibold text-black uppercase text-md">
                        @yield('page_title', 'Dashboard')
                    </div>

                </div>

                <div class="flex items-center gap-x-4">
                    <div class="flex flex-row gap-x-2.5 justify-center items-center">
                                @php
                                    $userNotifications = Auth::user()->notifications()->latest()->get()->map(function($n) {
                                            return [
                                                'receiver' => $n->data['send_to'],
                                                'sent_by' => $n->data['sent_by'],
                                                'message' => $n->data['message'],
                                                'image' => '../images/artem.jpg' // Or pick dynamically if you store sender avatar
                                            ];
                                        });
                                @endphp
                        <!-- paper-plane icon -->
                        <div x-data="notificationList({{ $userNotifications->toJson() }})" class="relative">
                            <button id="userMenuButton" class="text-black flex items-center space-x-2 focus:outline-none cursor-pointer">
                                <!-- <i class="fas fa-paper-plane text-2xl cursor-pointer"></i> -->
                                    <div class="relative">
                                        <i class="fas fa-paper-plane text-2xl text-black cursor-pointer"></i>
                                        <!-- Badge -->
                                        <span 
                                            x-show="notifications.length > 0" 
                                            x-text="notifications.length" 
                                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
                                        ></span>
                                    </div>
                            </button>
                                                        <!-- Person Dropdown -->
                            <div id="userDropdown" class="hidden absolute right-full mt-2 -ml-4 w-[20rem] bg-white border border-gray-200 rounded-md shadow-lg z-50">

                                <div x-data="{ 
                                    notifications: {{ $userNotifications->toJson() }},
                                    showModal: false,
                                    selectedNotification: null
                                    }" class="border rounded shadow">

                                    <h3 class="font-semibold py-3 bg-red-300 text-white px-4">Recommendation Notifications</h3>

                                    <ul class="text-sm text-gray-600 divide-y divide-gray-200 overflow-y-auto max-h-60">
                                        <template x-for="(notification, index) in notifications" :key="index">   
                                            <li class="flex items-center justify-between gap-2 px-4 py-3 w-full">
                                               <!-- ##<div  -->
                                                    <!-- class="flex items-center gap-3 cursor-pointer" -->
                                                    <!-- @click="selectedNotification = notification; showModal = true" -->
                                                <!-- > -->
                                                    <!-- <img :src="notification.image" alt="icon" class="w-8 h-8 rounded-full ring-1 ring-gray-400"> -->
                                                    <!-- <span x-text="notification.message"></span> -->
                                                <!-- </div>## -->
                                                <div 
                                                    class="flex items-center gap-3 cursor-pointer"
                                                    @click="
                                                        selectedNotification = notification; 
                                                        showModal = true; 
                                                        document.getElementById('userDropdown').classList.add('hidden')
                                                    "
                                                    >
                                                    <img :src="notification.image" alt="icon" class="w-8 h-8 rounded-full ring-1 ring-gray-400">
                                                    <span x-text="notification.message"></span>
                                                </div>

                                                <button @click="removeNotification(index)" class="text-gray-400 hover:text-red-500">
                                                    <i class="fas fa-times text-sm"></i>
                                                </button>
                                            </li>
                                        </template>
                                    </ul>

                                    <span class="bg-red-300 w-full p-2 flex justify-center items-center cursor-pointer hover:bg-gray-800">
                                        <i class="fas fa-plus text-md text-white px-3"></i>
                                        <span class="text-white text-sm">View All</span>
                                    </span>
                                    
                                    <div 
                                        x-show="showModal" 
                                        x-transition 
                                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
                                        >
                                        <div class="bg-white rounded-lg w-96 p-6 relative shadow border">
                                            <button 
                                                @click="showModal = false" 
                                                class="absolute top-2 right-2 text-gray-500 hover:text-black"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>

                                            <h3 class="font-semibold text-lg mb-4">Recommendation Message</h3>
                                            <p class="mb-4 text-gray-700" x-text="selectedNotification?.message"></p>

                                            <div x-data="{ showReply: false, replyText: '' }">
                                                <template x-if="showReply">
                                                    <div>
                                                        <textarea 
                                                            x-model="replyText" 
                                                            placeholder="Type your reply..." 
                                                            class="w-full border border-gray-300 rounded p-2 mb-3"
                                                            rows="3"
                                                        ></textarea>
                                                        <div class="flex justify-end gap-2">
                                                            <button 
                                                                @click="showReply = false"
                                                                class="px-3 py-1 text-gray-600 rounded hover:text-black text-sm"
                                                            >
                                                                Cancel
                                                            </button>
                                                            <button 
                                                                @click="
                                                                    if (replyText.trim() !== '') {
                                                                        alert('Reply sent: ' + replyText);
                                                                        replyText = '';
                                                                        showReply = false;
                                                                        showModal = false;
                                                                    }
                                                                "
                                                                class="px-4 py-1 bg-orange-500 text-white rounded hover:bg-orange-600 text-sm"
                                                            >
                                                                Send
                                                            </button>
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="!showReply">
                                                    <div class="flex justify-end">
                                                        <button 
                                                            @click="showReply = true"
                                                            class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 text-sm"
                                                        >
                                                            Reply
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- <div 
                                    x-data="{ 
                                        notifications: {{ $userNotifications->toJson() }},
                                        showModal: false,
                                        selectedNotification: null,
                                        showDropdown: false 
                                    }" 
                                    class="relative"
                                    >
                                    
                                    <button @click="showDropdown = !showDropdown">
                                        <i class="fas fa-bell"></i>
                                    </button>

                                    <div 
                                        x-show="showDropdown"
                                        @click.away="showDropdown = false"
                                        class="absolute right-0 mt-2 w-[20rem] bg-white border border-gray-200 rounded-md shadow-lg z-50"
                                    >
                                        
                                        <h3 class="font-semibold py-3 bg-red-300 text-white px-4">Recommendation Notifications</h3>

                                        <ul class="text-sm text-gray-600 divide-y divide-gray-200 overflow-y-auto max-h-60">
                                            <template x-for="(notification, index) in notifications" :key="index">   
                                                <li class="flex items-center justify-between gap-2 px-4 py-3 w-full">
                                                    <div 
                                                        class="flex items-center gap-3 cursor-pointer"
                                                        @click="
                                                            selectedNotification = notification;
                                                            showModal = true;
                                                            showDropdown = false;
                                                        "
                                                    >
                                                        <img :src="notification.image" alt="icon" class="w-8 h-8 rounded-full ring-1 ring-gray-400">
                                                        <span x-text="notification.message"></span>
                                                    </div>
                                                    <button @click="notifications.splice(index, 1)" class="text-gray-400 hover:text-red-500">
                                                        <i class="fas fa-times text-sm"></i>
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>

                                        <span class="bg-red-300 w-full p-2 flex justify-center items-center cursor-pointer hover:bg-gray-800">
                                            <i class="fas fa-plus text-md text-white px-3"></i>
                                            <span class="text-white text-sm">View All</span>
                                        </span>
                                    </div>

                                    <div 
                                        x-show="showModal" 
                                        x-transition 
                                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
                                    >
                                        <div class="bg-white rounded-lg w-96 p-6 relative shadow border">
                                            <button 
                                                @click="showModal = false" 
                                                class="absolute top-2 right-2 text-gray-500 hover:text-black"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>

                                            <h3 class="font-semibold text-lg mb-4">Recommendation Message</h3>
                                            <p class="mb-4 text-gray-700" x-text="selectedNotification?.message"></p>

                                            <div x-data="{ showReply: false, replyText: '' }">
                                                <template x-if="showReply">
                                                    <div>
                                                        <textarea 
                                                            x-model="replyText" 
                                                            placeholder="Type your reply..." 
                                                            class="w-full border border-gray-300 rounded p-2 mb-3"
                                                            rows="3"
                                                        ></textarea>
                                                        <div class="flex justify-end gap-2">
                                                            <button 
                                                                @click="showReply = false"
                                                                class="px-3 py-1 text-gray-600 rounded hover:text-black text-sm"
                                                            >
                                                                Cancel
                                                            </button>
                                                            <button 
                                                                @click="
                                                                    if (replyText.trim() !== '') {
                                                                        alert('Reply sent: ' + replyText);
                                                                        replyText = '';
                                                                        showReply = false;
                                                                        showModal = false;
                                                                    }
                                                                "
                                                                class="px-4 py-1 bg-orange-500 text-white rounded hover:bg-orange-600 text-sm"
                                                            >
                                                                Send
                                                            </button>
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="!showReply">
                                                    <div class="flex justify-end">
                                                        <button 
                                                            @click="showReply = true"
                                                            class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 text-sm"
                                                        >
                                                            Reply
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>


                        <!-- New Bell Icon Dropdown (Leave this) -->
                        <div  class="relative">                            
                                <!-- User Menu Button -->
                                <button class="text-black flex items-center space-x-2 focus:outline-none cursor-pointer">
                                    <div class="relative">
                                        <i class="fas fa-bell text-2xl text-black"></i>
                                        <!-- Badge -->
                                        <span 
                                            x-show="notifications.length > 0" 
                                            x-text="notifications.length" 
                                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
                                        ></span>
                                    </div>
                                </button>
                            
                            <!-- Person Dropdown -->
                            <div id="userDropdown" class="hidden absolute right-full mt-2 -ml-4 w-[20rem] bg-white border border-gray-200 rounded-md shadow-lg z-50">

                                <div class="border rounded shadow">
                                    <!-- Header -->
                                    <h3 class="font-semibold py-3 bg-black text-white px-4">Notifications</h3>

                                    <!-- Scrollable list -->
                                    <ul class="text-sm text-gray-600 divide-y divide-gray-200 overflow-y-auto max-h-60">
                                        
                                        <template x-for="(notification, index) in notifications" :key="index">   
                                            <li class="flex items-center justify-between gap-2 px-4 py-3 w-full">
                                                <div class="flex items-center gap-3">
                                                    <img :src="notification.image" alt="icon" class="w-8 h-8 rounded-full ring-1 ring-gray-400">
                                                    <span x-text="notification.message"></span>
                                                    <!-- <span x-text="notification.sent_by"></span>
                                                    <span x-text="notification.receiver"></span> -->
                                                </div>
                                                <button @click="removeNotification(index)" class="text-gray-400 hover:text-red-500">
                                                    <i class="fas fa-times text-sm"></i>
                                                </button>
                                            </li>
                                        </template>
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

                    <!-- Person images dropdown -->
                    <div class="relative">

                        <!-- User Menu Button -->
                        <button id="userMenuButton" class="text-black flex items-center space-x-2 focus:outline-none cursor-pointer">
                            <div class="relative">
                                <div class="w-10">
                                    @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" class="rounded-full h-10 w-10 object-cover">
                                    @else
                                    <!-- Default avatar - you can use any placeholder image -->
                                     <img src="{{ asset('images/wildfire.jpg') }}" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                     @endif
                                    
                                </div>
                                <span class="absolute bottom-0 right-0 block w-3 h-3 rounded-full bg-green-500 border-2 border-white"></span>
                            </div>
                            <span class="font-semibold text-black text-sm">
                                {{ Auth::user()->username }}
                            </span>
                        </button>

                        <!-- Person Dropdown -->
                        <div id="userDropdown" class="hidden absolute right-0 top-full mt-2 w-fit bg-white border border-gray-200 rounded-md shadow-lg py-4 z-50">
                            <div class="flex flex-row justify-start items-center gap-x-6 w-full px-5">
                                <div class="w-16">
                                    @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" class="rounded-full h-10 w-10 object-cover">
                                    @else
                                    <!-- Default avatar - you can use any placeholder image -->
                                     <img src="{{ asset('images/wildfire.jpg') }}" alt="Zimamoto Logo" class="w-full rounded-full ring-1 ring-gray-400" />
                                     @endif
                                </div>
                                <div class="flex flex-col justify-start items-start w-full">
                                    <span class="font-semibold text-black text-md">
                                        {{ Auth::user()->username }}
                                    </span>
                                    <span class="text-black text-xs">{{ Auth::user()->job_title }}</span>
                                </div>
                            </div>

                            <hr class="my-4 border-t-2 border-gray-400 w-full" />
                            
                            <div class="px-5 w-full">
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-user text-gray-500"></i> Profile Details
                                </a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100 w-full">
                                    <i class="fas fa-key text-gray-500"></i> Change Password
                                </a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-2 py-2 text-md text-gray-700 hover:bg-gray-100 w-full">
                                    <i class="fas fa-cog text-gray-500"></i> Settings
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

        // person image dropdown
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

    </script>

    <script>
        function notificationList(initialNotifications) {
            return {
                notifications: initialNotifications,

                init() {
                    document.addEventListener('add-recommendation', () => {
                        this.addNotification();
                    });
                },

                removeNotification(index) {
                    console.log('Removing notification at index:', index);
                    this.notifications.splice(index, 1);
                },

                addNotification() {
                    const newNotif = { image: '../images/artem.jpg', message: 'New Recommendation Received!' };
                    console.log('Adding notification:', newNotif);
                    this.notifications.unshift(newNotif); 
                }
            }
        }
    </script>


</body>
</html>
