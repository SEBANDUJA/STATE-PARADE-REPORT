<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- overview cards -->
    <section class="grid grid-cols-4 justify-center place-items-center w-full">
        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-8 aspect-video">
            <div>
                <i class="bi bi-people-fill text-orange-500 text-5xl"></i>
            </div>
            <div class="flex flex-col gap-y-2">
                <span class="text-md uppercase font-semibold">Total students</span>

                <div class="flex justify-center items-center space-x-4">
                    <div>
                        <span class="text-xs">Basic</span>
                        <span class="text-xl font-semibold flex justify-center">{{ $students_count }}</span>
                    </div>

                    <!-- Vertical divider -->
                    <div class="h-8 border-l-2 border-gray-400"></div>

                    <div>
                        <span class="text-xs">In Service</span>
                        <span class="text-xl font-semibold text-center flex justify-center">{{ $students_count }}</span>
                    </div>
                </div>                
            </div>
        </div>

        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10 aspect-video">
            <div>
                <i class="bi bi-journal-bookmark-fill text-orange-500 text-5xl"></i>
            </div>
            <div class="flex flex-col gap-y-2">
                <span class="text-md uppercase font-semibold font-semibold">Permission</span>
                <div class="flex justify-center items-center space-x-4">
                    <div>
                        <span class="text-xs">Basic</span>
                        <span class="text-xl font-semibold flex justify-center">13</span>
                    </div>

                    <!-- Vertical divider -->
                    <div class="h-8 border-l-2 border-gray-400"></div>

                    <div>
                        <span class="text-xs">In Service</span>
                        <span class="text-xl font-semibold text-center flex justify-center">03</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10 aspect-video">
            <div>
                <i class="bi bi-person-fill text-orange-500 text-5xl"></i>
            </div>
            <div class="flex flex-col gap-y-2 font-semibold">
                <span class="text-md uppercase font-semibold">Total users</span>
                <span class="text-xl flex justify-center">{{ $users_count }}</span>
            </div>
        </div>

        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10 aspect-video">
            <div>
                <i class="bi bi-book text-orange-500 text-5xl"></i>
            </div>
            <div class="flex flex-col gap-y-2 font-semibold">
                <span class="text-md uppercase font-semibold">Total Course</span>
                <span class="text-xl flex justify-center">2</span>
            </div>
        </div>

    </section>

    <!-- graph -->
    <section class="grid grid-cols-2 justify-center place-items-center gap-x-1">

        <!-- bar graph -->
        <div class=" p-6 rounded mt-16">
            <h2 class="text-lg font-bold mb-6 text-center">Monthly status</h2>

            <div class="flex justify-around items-end space-x-6 h-48 border-b border-gray-300 px-4">

                <!-- Group 1: Instructors -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-orange-400 rounded-t" style="height: 70%;"></div>
                        <div class="w-6 bg-orange-300 rounded-t" style="height: 50%;"></div>
                        <div class="w-6 bg-orange-100 rounded-t" style="height: 30%;"></div>
                        <div class="w-6 bg-orange-200 rounded-t" style="height: 40%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">First Week</span>
                </div>

                <!-- Group 2: Instructors -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-orange-400 rounded-t" style="height: 60%;"></div>
                        <div class="w-6 bg-orange-300 rounded-t" style="height: 40%;"></div>
                        <div class="w-6 bg-orange-100 rounded-t" style="height: 10%;"></div>
                        <div class="w-6 bg-orange-200 rounded-t" style="height: 20%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">Second Week</span>
                </div>

                <!-- Group 3: Courses -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-orange-400 rounded-t" style="height: 80%;"></div>
                        <div class="w-6 bg-orange-300 rounded-t" style="height: 70%;"></div>
                        <div class="w-6 bg-orange-200 rounded-t" style="height: 50%;"></div>
                        <div class="w-6 bg-orange-100 rounded-t" style="height: 30%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">Third Week</span>
                </div>

                <!-- Group 4: Graduates -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-orange-300 rounded-t" style="height: 50%;"></div>
                        <div class="w-6 bg-orange-200 rounded-t" style="height: 30%;"></div>
                        <div class="w-6 bg-orange-100 rounded-t" style="height: 20%;"></div>
                        <div class="w-6 bg-orange-400 rounded-t" style="height: 70%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">Fourth Week</span>
                </div>

            </div>

            <!-- key -->
            <div class="mt-12">
                <h2 class="font-bold">Key</h2>
                <div class="flex flex-col gap-y-1">
                    <div class="flex flex-row gap-x-4 justify-start items-center mt-2">
                        <span class="inline-block bg-orange-100 rounded-full h-5 w-5"></span>
                        <span>Very Low (0% - 20%) </span>
                    </div>
                    <div class="flex flex-row gap-x-4 justify-start items-center">
                        <span class="inline-block bg-orange-200 rounded-full h-5 w-5"></span>
                        <span>Low (21% - 40%) </span>
                    </div>
                    <div class="flex flex-row gap-x-4 justify-start items-center">
                        <span class="inline-block bg-orange-300 rounded-full h-5 w-5"></span>
                        <span>Moderate (41% - 60%) </span>
                    </div>
                    <div class="flex flex-row gap-x-4 justify-start items-center">
                        <span class="inline-block bg-orange-400 rounded-full h-5 w-5"></span>
                        <span>High (61% - 80%) </span>
                    </div>
                    <div class="flex flex-row gap-x-4 justify-start items-center">
                        <span class="inline-block bg-orange-500 rounded-full h-5 w-5"></span>
                        <span>Very High / Exellent (81% - 100%) </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trending line graph -->
        <div class="max-w-4xl mx-auto p-12 bg-white rounded mt-">
            <h2 class="text-lg font-bold mb-6 text-center">Trending Line Graph</h2>

            <!-- X & Y Axis -->
            <div class="relative h-48 w-full border-l border-b border-gray-300">
                <!-- SVG Line Chart -->
                <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 300 100" preserveAspectRatio="none">
                    <!-- Students Line (blue) -->
                    <polyline
                        fill="none"
                        stroke="#3B82F6"
                        stroke-width="2"
                        points="0,70 100,50 200,30" />
                    
                    <!-- Instructors Line (green) -->
                    <polyline
                        fill="none"
                        stroke="#10B981"
                        stroke-width="2"
                        points="0,80 100,70 200,60" />

                    <!-- Courses Line (yellow) -->
                    <polyline
                        fill="none"
                        stroke="#FACC15"
                        stroke-width="2"
                        points="0,60 100,40 200,10" />

                    <!-- Graduates Line (red) -->
                    <polyline
                        fill="none"
                        stroke="#EF4444"
                        stroke-width="2"
                        points="0,75 100,65 200,50" />
                </svg>
            </div>

            <!-- Legend -->
            <div class="mt-4 flex justify-center space-x-6 text-sm text-gray-700">
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-orange-100 block"></span>Sick in</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-orange-200 block"></span>Sick Out</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-orange-300 block"></span>Ed</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-orange-400 block"></span>Ld</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-orange-400 block"></span>Permission</div>
            </div>
        </div>


    </section>

@endsection
