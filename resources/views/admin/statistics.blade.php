<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Statistics')

@section('content')

<!-- Filter section -->
<section class="max-w-6xl mx-auto mb-8 p-6 bg-white shadow rounded">
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-bold">Visualization</h2>
        <form method="GET" action="{{ route('statistics') }}" class="flex items-center gap-x-4">
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

<!-- Additional Graphs below -->
<section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 px-4 mb-10">
    <!-- Pie Chart -->
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-center font-semibold mb-4">Pie Chart: Distribution</h3>
        <canvas id="pieChart" class="w-full h-64"></canvas>
    </div>

    <!-- Radar Chart -->
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-center font-semibold mb-4">Radar Chart: Comparison</h3>
        <canvas id="radarChart" class="w-full h-64"></canvas>
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

    // Grouped Bar Chart
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

    // Pie Chart
    const pieChartCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieChartCtx, {
        type: 'pie',
        data: {
            labels: ['ED', 'Absent', 'Sick In', 'Sick Out', 'Permission'],
            datasets: [{
                data: [
                    edData.reduce((a, b) => a + b, 0),
                    absentData.reduce((a, b) => a + b, 0),
                    sickInData.reduce((a, b) => a + b, 0),
                    sickOutData.reduce((a, b) => a + b, 0),
                    permissionData.reduce((a, b) => a + b, 0)
                ],
                backgroundColor: [
                    '#FB923C', // ED
                    '#EF4444', // Absent
                    '#22C55E', // Sick In
                    '#3B82F6', // Sick Out
                    '#6366F1'  // Permission
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Radar Chart
    const radarChartCtx = document.getElementById('radarChart').getContext('2d');
    new Chart(radarChartCtx, {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'ED',
                    data: edData,
                    backgroundColor: 'rgba(251, 146, 60, 0.2)',
                    borderColor: '#FB923C',
                    pointBackgroundColor: '#FB923C'
                },
                {
                    label: 'Sick In',
                    data: sickInData,
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    borderColor: '#22C55E',
                    pointBackgroundColor: '#22C55E'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    angleLines: { color: '#ddd' },
                    grid: { color: '#eee' },
                    pointLabels: {
                        font: { weight: 'bold' }
                    }
                }
            }
        }
    });
</script>

@endsection
