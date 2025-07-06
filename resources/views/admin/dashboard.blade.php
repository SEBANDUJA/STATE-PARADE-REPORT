<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<!-- Summary cards -->
<section class="grid grid-cols-4 gap-4 w-full mb-10 pt-20">
    <div class="flex items-center gap-x-6 shadow-md p-6">
        <i class="bi bi-people-fill text-orange-500 text-4xl"></i>
        <div>
            <div class="text-sm uppercase font-bold">Total Students</div>
            <div class="flex flex-row justify-center items-center gap-x-4 mt-2">
                <div class="flex flex-col">
                    <span class="text-sm">Basic</span>
                    <div class="text-xl font-bold text-center">{{ $students_count }}</div>
                </div>
                <div class="h-10 border-1 border-black"></div>
                <div class="flex flex-col">
                    <span class="text-sm">In service</span>
                    <div class="text-xl font-bold text-center">{{ $students_count }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-x-6 shadow-md p-6">
        <i class="bi bi-journal-bookmark-fill text-orange-500 text-4xl"></i>
        <div>
            <div class="text-sm uppercase font-bold">Permission</div>
            <div class="flex flex-row justify-center items-center gap-x-4 mt-2">
                <div class="flex flex-col">
                    <span class="text-sm">Basic</span>
                    <div class="text-xl font-bold text-center">0</div>
                </div>
                <div class="h-10 border-1 border-black"></div>
                <div class="flex flex-col">
                    <span class="text-sm">In service</span>
                    <div class="text-xl font-bold text-center">0</div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-x-6 shadow-md p-6">
        <i class="bi bi-person-fill text-orange-500 text-4xl"></i>
        <div>
            <div class="text-sm uppercase font-bold">Total Users</div>
            <div class="text-xl font-bold">{{ $users_count }}</div>
        </div>
    </div>
    <div class="flex items-center gap-x-6 shadow-md p-6">
        <i class="bi bi-book text-orange-500 text-4xl"></i>
        <div>
            <div class="text-sm uppercase font-bold">Total Course</div>
            <div class="text-xl font-bold">2</div>
        </div>
    </div>
</section>

<!-- Filter section -->
<section class="max-w-6xl mx-auto mb-8 p-6 bg-white shadow rounded">
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-bold">Visualization</h2>
        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-x-4">
            <label for="month" class="text-sm font-medium">Filter by Month:</label>
            <input type="month" id="month" name="month" value="{{ $selectedMonth }}" class="border px-3 py-2 rounded">
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Apply</button>
        </form>
    </div>
</section>

<!-- Graphs side by side -->
<section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 px-4 mb-10">
    <!-- Line Chart -->
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-center font-semibold mb-4">Line Chart: ED / Absent / Sick Out</h3>
        <canvas id="trendChart" class="w-full h-64"></canvas>
    </div>

    <!-- Grouped Bar Chart -->
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-center font-semibold mb-4">Grouped Bar Chart</h3>
        <canvas id="groupedBarChart" class="w-full h-64"></canvas>
    </div>
</section>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const rawDates = {!! json_encode($dates) !!};
    const edData = {!! json_encode(array_values($edCounts->toArray())) !!};
    const absentData = {!! json_encode(array_values($absentCounts->toArray())) !!};
    const sickOutData = {!! json_encode(array_values($sickOutCounts->toArray())) !!};
    const sickInData = {!! json_encode(array_values($sickInCounts->toArray())) !!};
    const permissionData = {!! json_encode(array_values($permissionCounts->toArray())) !!};

    // Helper: format like 21st, 22nd etc.
    function formatDayLabel(dateString) {
        const day = new Date(dateString).getDate();
        const suffix = (d) => {
            if (d > 3 && d < 21) return 'th';
            switch (d % 10) {
                case 1: return 'st';
                case 2: return 'nd';
                case 3: return 'rd';
                default: return 'th';
            }
        };
        return `${day}${suffix(day)}`;
    }

    const labels = rawDates.map(date => formatDayLabel(date));

    // Line Chart
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'ED',
                    data: edData,
                    borderColor: '#FB923C',
                    backgroundColor: 'transparent',
                    tension: 0.4
                },
                {
                    label: 'Absent',
                    data: absentData,
                    borderColor: '#EF4444',
                    backgroundColor: 'transparent',
                    tension: 0.4
                },
                {
                    label: 'Sick Out',
                    data: sickOutData,
                    borderColor: '#3B82F6',
                    backgroundColor: 'transparent',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1200,
                easing: 'easeOutCubic'
            },
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date',
                        font: { weight: 'bold' }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count',
                        font: { weight: 'bold' }
                    }
                }
            }
        }
    });

    // Bar Chart with Animation
    new Chart(document.getElementById('groupedBarChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'ED',
                    data: edData,
                    backgroundColor: '#FB923C',
                    maxBarThickness: 18
                },
                {
                    label: 'Sick In',
                    data: sickInData,
                    backgroundColor: '#22C55E',
                    maxBarThickness: 18
                },
                {
                    label: 'Sick Out',
                    data: sickOutData,
                    backgroundColor: '#FACC15',
                    maxBarThickness: 18
                },
                {
                    label: 'Permission',
                    data: permissionData,
                    backgroundColor: '#6366F1',
                    maxBarThickness: 18
                }
            ]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1200,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date',
                        font: { weight: 'bold' }
                    },
                    barPercentage: 0.6,
                    categoryPercentage: 0.5
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count',
                        font: { weight: 'bold' }
                    }
                }
            }
        }
    });
</script>

@endsection











