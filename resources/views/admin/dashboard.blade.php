<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <!-- overview cards -->
    <section class="grid grid-cols-4 justify-center place-items-center w-full">
        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10">
            <div>
                <i class="bi bi-people-fill text-blue-400 text-6xl"></i>
            </div>
            <div class="flex flex-col gap-y-2 font-semibold">
                <span class="text-md uppercase font-thin">Total students</span>
                <span class="text-xl">432</span>
            </div>
        </div>

        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10">
            <div>
                <i class="bi bi-journal-bookmark-fill text-blue-400 text-6xl"></i>
            </div>
            <div class="flex flex-col gap-y-2 font-semibold">
                <span class="text-md uppercase font-thin">Permission</span>
                <span class="text-xl">32</span>
            </div>
        </div>

        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10">
            <div>
                <i class="bi bi-person-fill text-blue-400 text-6xl"></i>
            </div>
            <div class="flex flex-col gap-y-2 font-semibold">
                <span class="text-md uppercase font-thin">Total users</span>
                <span class="text-xl">6</span>
            </div>
        </div>

        <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10">
            <div>
                <i class="bi bi-book-fill text-blue-400 text-6xl"></i>
            </div>
            <div class="flex flex-col gap-y-2 font-semibold">
                <span class="text-md uppercase font-thin">Total Course</span>
                <span class="text-xl">2</span>
            </div>
        </div>

    </section>

    <!-- graph -->
    <section class="grid grid-cols-2 justify-center place-items-center gap-x-1">

        <!-- bar graph -->
        <div class="max-w-xl mx-auto p-6 bg-white shadow rounded ">
            <h2 class="text-lg font-bold mb-6 text-center">Monthly status</h2>

            <div class="flex justify-around items-end space-x-6 h-48 border-b border-gray-300 px-4">

                <!-- Group 1: Students -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-blue-500 rounded-t" style="height: 70%;"></div>
                        <div class="w-6 bg-blue-300 rounded-t" style="height: 50%;"></div>
                        <div class="w-6 bg-blue-100 rounded-t" style="height: 30%;"></div>
                        <div class="w-6 bg-blue-200 rounded-t" style="height: 40%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">First Week</span>
                </div>

                <!-- Group 2: Instructors -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-blue-400 rounded-t" style="height: 60%;"></div>
                        <div class="w-6 bg-blue-100 rounded-t" style="height: 40%;"></div>
                        <div class="w-6 bg-blue-300 rounded-t" style="height: 10%;"></div>
                        <div class="w-6 bg-blue-500 rounded-t" style="height: 20%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">Second Week</span>
                </div>

                <!-- Group 3: Courses -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-blue-400 rounded-t" style="height: 80%;"></div>
                        <div class="w-6 bg-blue-300 rounded-t" style="height: 70%;"></div>
                        <div class="w-6 bg-blue-100 rounded-t" style="height: 50%;"></div>
                        <div class="w-6 bg-blue-500 rounded-t" style="height: 30%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">Third Week</span>
                </div>

                <!-- Group 4: Graduates -->
                <div class="flex flex-col items-center space-x-1 space-y-1">
                    <div class="flex space-x-1 items-end h-40">
                        <div class="w-6 bg-blue-500 rounded-t" style="height: 50%;"></div>
                        <div class="w-6 bg-blue-100 rounded-t" style="height: 30%;"></div>
                        <div class="w-6 bg-blue-400 rounded-t" style="height: 20%;"></div>
                        <div class="w-6 bg-blue-200 rounded-t" style="height: 70%;"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">Fourth Week</span>
                </div>

            </div>
        </div>

        <div class="max-w-4xl mx-auto p-12 bg-white shadow rounded mt-10">
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

                <!-- X-Axis Labels -->
                <div class="absolute bottom-0 left-0 w-full flex justify-between px-8 text-xs text-gray-500">
                    <span>A</span>
                    <span>B</span>
                    <span>C</span>
                </div>
            </div>

            <!-- Legend -->
            <div class="mt-4 flex justify-center space-x-6 text-sm text-gray-700">
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-blue-500 block"></span>Students</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-green-500 block"></span>Instructors</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-yellow-400 block"></span>Courses</div>
                <div class="flex items-center space-x-2"><span class="w-4 h-2 bg-red-500 block"></span>Graduates</div>
            </div>
        </div>


    </section>
@endsection
