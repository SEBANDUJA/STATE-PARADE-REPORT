<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Summary cards -->
<section class="grid grid-cols-4 justify-center place-items-center w-full mb-10">
    <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-8 aspect-video">
        <div><i class="bi bi-people-fill text-orange-500 text-5xl"></i></div>
        <div class="flex flex-col gap-y-2">
            <span class="text-md uppercase font-semibold">Total students</span>
            <div class="flex justify-center items-center space-x-4">
                <div>
                    <span class="text-xs">Basic</span>
                    <span class="text-xl font-semibold flex justify-center">{{ $students_count }}</span>
                </div>
                <div class="h-8 border-l-2 border-gray-400"></div>
                <div>
                    <span class="text-xs">In Service</span>
                    <span class="text-xl font-semibold text-center flex justify-center">{{ $students_count }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10 aspect-video">
        <div><i class="bi bi-journal-bookmark-fill text-orange-500 text-5xl"></i></div>
        <div class="flex flex-col gap-y-2">
            <span class="text-md uppercase font-semibold">Permission</span>
            <div class="flex justify-center items-center space-x-4">
                <div>
                    <span class="text-xs">Basic</span>
                    <span class="text-xl font-semibold flex justify-center">13</span>
                </div>
                <div class="h-8 border-l-2 border-gray-400"></div>
                <div>
                    <span class="text-xs">In Service</span>
                    <span class="text-xl font-semibold text-center flex justify-center">03</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10 aspect-video">
        <div><i class="bi bi-person-fill text-orange-500 text-5xl"></i></div>
        <div class="flex flex-col gap-y-2 font-semibold">
            <span class="text-md uppercase font-semibold">Total users</span>
            <span class="text-xl flex justify-center">{{ $users_count }}</span>
        </div>
    </div>

    <div class="flex flex-row justify-start items-center gap-x-6 shadow-md w-full p-10 aspect-video">
        <div><i class="bi bi-book text-orange-500 text-5xl"></i></div>
        <div class="flex flex-col gap-y-2 font-semibold">
            <span class="text-md uppercase font-semibold">Total Course</span>
            <span class="text-xl flex justify-center">2</span>
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

<!-- Graphs side-by-side -->
<section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 px-4">
    <!-- Line Chart -->
    <div class="bg-white shadow rounded p-4">
        <h3 class="text-center font-semibold mb-4">ED / Absent / Sick Out</h3>
        <canvas id="trendChart" class="w-full h-64"></canvas>
    </div>

    <!-- Bar Chart -->
    <div class="bg-white shadow rounded p-4">
        <h3 class="text-center font-semibold mb-4">ED Totals by Day</h3>
        <canvas id="barChart" class="w-full h-64"></canvas>
    </div>
</section>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart rendering -->
<script>
    // Helper: format day suffix (1st, 2nd, 3rd, 4th...)
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

    const rawDates = {!! json_encode($dates) !!};
    const labels = rawDates.map(date => formatDayLabel(date));

    const edData = {!! json_encode($edCounts) !!};
    const absentData = {!! json_encode($absentCounts) !!};
    const sickOutData = {!! json_encode($sickOutCounts) !!};

    // Line Chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'ED',
                    data: edData,
                    borderColor: '#1D4ED8',
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
                    borderColor: '#EAB308',
                    backgroundColor: 'transparent',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: false },
                legend: { display: true, position: 'bottom' }
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

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ED Count',
                data: edData,
                backgroundColor: '#EA580C'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: false },
                legend: { display: false }
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
</script>

@endsection

