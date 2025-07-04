@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Firemanship Report')
@section('page_title', 'Firemanship Report')

@section('content')

<!-- ✅ A4 Landscape Print Styles -->
<style>
    @media print {
        .no-print {
            display: none !important;
        }

        @page {
            size: A4 landscape;
            margin: 1cm;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .print-container {
            width: 100%;
            max-width: 26cm;
            margin: 0 auto;
        }

        table, tr, td, th {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
    }
</style>

<!-- ✅ Report content constrained to A4 width -->
<div class="print-container">
    <div class="flex flex-col justify-center items-center w-full">
        <div class="flex flex-col uppercase justify-center items-center text-lg font-semibold">
            <h1>Ministry of Home Affairs</h1>
            <h1>Fire and Rescue Training Institute</h1>
        </div>

        <div class="flex flex-row uppercase justify-between items-center w-full mt-5 font-semibold">
            <h1>Session<span> ______</span></h1>
            <h1>State Parade</h1>
            <h1>Date: {{ $currentDate }}</h1>
        </div>

        <hr class="my-4 border-t-2 border-gray-400 w-full" />

        <div class="flex flex-row uppercase justify-between items-center w-full font-semibold">
            <span>Number<span>:05</span></span>
            <span>Course Report (Basic Firemanship No. 05: 2025)</span>
            <span></span>
        </div>
    </div>

    <table class="table-auto w-full border border-gray-300 text-sm text-center mt-5">
        <thead class="bg-white text-black uppercase">
            <tr>
                <th class="border px-2 py-6">Coy</th>
                <th class="border px-2 py-3">Present</th>
                <th class="border px-2 py-3">Absent</th>
                <th class="border px-2 py-3">Sick In</th>
                <th class="border px-2 py-3">Sick Out</th>
                <th class="border px-2 py-3">ED</th>
                <th class="border px-2 py-3">LD</th>
                <th class="border px-2 py-3">Pass</th>
                <th class="border px-2 py-3">Permission</th>
                <th class="border px-2 py-3">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $row)
                <tr class="bg-white border">
                    <td class="border px-2 py-4 font-semibold">{{ $row->company }}-COY</td>
                    <td class="border px-2 py-4">{{ $row->present }}</td>
                    <td class="border px-2 py-4">{{ $row->absent }}</td>
                    <td class="border px-2 py-4">{{ $row->sick_in }}</td>
                    <td class="border px-2 py-4">{{ $row->sick_out }}</td>
                    <td class="border px-2 py-4">{{ $row->ed }}</td>
                    <td class="border px-2 py-4">{{ $row->ld }}</td>
                    <td class="border px-2 py-4">{{ $row->pass }}</td>
                    <td class="border px-2 py-4">{{ $row->permission }}</td>
                    <td class="border px-2 py-4 font-bold">{{ $row->total }}</td>
                </tr>
            @endforeach

            <tr class="bg-gray-200 font-bold">
                <td class="border px-2 py-4">Total</td>
                <td class="border px-2 py-4">{{ $totals['present'] }}</td>
                <td class="border px-2 py-4">{{ $totals['absent'] }}</td>
                <td class="border px-2 py-4">{{ $totals['sick_in'] }}</td>
                <td class="border px-2 py-4">{{ $totals['sick_out'] }}</td>
                <td class="border px-2 py-4">{{ $totals['ed'] }}</td>
                <td class="border px-2 py-4">{{ $totals['ld'] }}</td>
                <td class="border px-2 py-4">{{ $totals['pass'] }}</td>
                <td class="border px-2 py-4">{{ $totals['permission'] }}</td>
                <td class="border px-2 py-4">{{ $totals['total'] }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Summary -->
    <div class="mt-8">
        <div class="flex flex-col justify-start items-start font-semibold">
            <span>Summary</span>
            <span>Male: {{ $maleCount }}</span>
            <span>Female: {{ $femaleCount }}</span>
        </div>

        <div class="mt-5">
            <h2 class="uppercase font-semibold">Other Particulars by Identity</h2>

            <!-- Row 1 -->
            <div class="grid grid-cols-4 items-stretch mt-2 gap-x-8">
                @foreach ([
                    'A: Absent' => $absentList,
                    'B: Sick In' => $sickInList,
                    'C: Sick Out' => $sickOutList,
                    'D: ED' => $edList,
                ] as $label => $list)
                    <div class="rounded p-2 h-full flex flex-col">
                        <span class="uppercase font-semibold">{{ $label }}</span>
                        <ol class="mt-2">
                            @forelse ($list as $student)
                                <li>{{ $loop->iteration }}. {{ $student->s_id }} - {{ $student->name }}</li>
                            @empty
                                <li class="text-gray-500">None</li>
                            @endforelse
                        </ol>
                    </div>
                @endforeach
            </div>

            <!-- Row 2 -->
            <div class="grid grid-cols-4 items-stretch mt-3 gap-x-8">
                @foreach ([
                    'E: LD' => $ldList,
                    'F: Permission' => $permissionList,
                    'G: Special Duty' => $specialDutyList,
                    'H: Pass' => $passList,
                ] as $label => $list)
                    <div class="rounded p-2 h-full flex flex-col">
                        <span class="uppercase font-semibold">{{ $label }}</span>
                        <ol class="mt-2">
                            @forelse ($list as $student)
                                <li>{{ $loop->iteration }}. {{ $student->s_id }} - {{ $student->name }}</li>
                            @empty
                                <li class="text-gray-500">None</li>
                            @endforelse
                        </ol>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Signature Section -->
        <div class="flex flex-col justify-center items-end uppercase mt-8 w-full mb-8">
            <h2 class="font-semibold">Signature</h2>
            <div class="flex flex-col gap-y-3 text-sm mt-3">
                <span>Sir Major: ____________</span>
                <span>Officer on Duty: ___________</span>
                <span>Chief Instructor: ___________</span>
            </div>
        </div>
    </div>

    <!-- ✅ Print Button -->
    <div class="flex justify-end items-end no-print mt-5">
        <button onclick="window.print()" class="w-fit h-10 px-4 rounded-md bg-orange-600 hover:border-2 hover:border-orange-600 hover:bg-white transition-all duration-500 ease-in uppercase text-xs text-white hover:text-black cursor-pointer flex items-center gap-2">
            <i class="fas fa-print"></i>
            Print Report
        </button>
    </div>
</div>

@endsection
