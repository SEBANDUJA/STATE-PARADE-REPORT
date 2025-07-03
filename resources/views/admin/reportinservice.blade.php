
@extends('layouts.admin')
@extends('layouts.app')

@section('title', 'Firemanship Report')
@section('page_title', 'Firemanship Report')

@section('content')
    @php
    // Sample data structure
    $data = [
        ['coy' => 'FIRE OFFICER LEVEL I', 'present' => 30, 'absent' => 2, 'sick_in' => 1, 'sick_out' => 0, 'ed' => 1, 'ld' => 0, 'pass' => 2, 'permission' => 1],
        ['coy' => 'INSPECTOR LEVEL I', 'present' => 28, 'absent' => 4, 'sick_in' => 1, 'sick_out' => 1, 'ed' => 0, 'ld' => 1, 'pass' => 1, 'permission' => 2],
        ['coy' => 'LEADING FIREMANSHIP LEVEL II', 'present' => 32, 'absent' => 1, 'sick_in' => 0, 'sick_out' => 1, 'ed' => 2, 'ld' => 1, 'pass' => 0, 'permission' => 0],
        ['coy' => 'LEADING FIREMANSHIP LEVEL I', 'present' => 29, 'absent' => 3, 'sick_in' => 1, 'sick_out' => 0, 'ed' => 1, 'ld' => 0, 'pass' => 1, 'permission' => 1],
        ['coy' => 'BASIC LEADING FIREMANSHIP LEVEL', 'present' => 29, 'absent' => 3, 'sick_in' => 1, 'sick_out' => 0, 'ed' => 1, 'ld' => 0, 'pass' => 1, 'permission' => 1],
    ];
    @endphp

    <div class="flex flex-col justify-center items-center w-full">
        <div class="flex flex-col uppercase justify-center items-center text-lg font-semibold">
            <h1>ministry of home affairs</h1>
            <h1>Fire and rescue training institute</h1>
        </div>
        <div class="flex flex-row uppercase justify-between items-center w-full mt-5 font-semibold">
            <h1>session<span> ______</span></h1>
            <h1>state parade</h1>
            <h1>date: ______</h1>
        </div>

        <hr class="my-4 border-t-2 border-gray-400 w-full" />

        <div class="flex flex-row uppercase justify-between items-center w-full font-semibold gap-x-12">
            <span>Number<span>_______</span></span>
            <span class="text-justify">course report (fire officer level i, inspector level i, leading firemanship level ii, leading firemanship level i and basic leading firemanship level 2025)</span>
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
            @foreach ($data as $row)
                <tr class="bg-white border">
                    <td class="border px-2 py-4 font-semibold">{{ $row['coy'] }}</td>
                    <td class="border px-2 py-4">{{ $row['present'] }}</td>
                    <td class="border px-2 py-4">{{ $row['absent'] }}</td>
                    <td class="border px-2 py-4">{{ $row['sick_in'] }}</td>
                    <td class="border px-2 py-4">{{ $row['sick_out'] }}</td>
                    <td class="border px-2 py-4">{{ $row['ed'] }}</td>
                    <td class="border px-2 py-4">{{ $row['ld'] }}</td>
                    <td class="border px-2 py-4">{{ $row['pass'] }}</td>
                    <td class="border px-2 py-4">{{ $row['permission'] }}</td>
                    <td class="border px-2 py-4 font-bold">
                        {{
                            $row['present'] + $row['absent'] + $row['sick_in'] + $row['sick_out'] +
                            $row['ed'] + $row['ld'] + $row['pass'] + $row['permission']
                        }}
                    </td>
                </tr>
            @endforeach

            {{-- Totals --}}
            <tr class="bg-gray-200 font-bold">
                <td class="border px-2 py-4">Total</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('present') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('absent') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('sick_in') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('sick_out') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('ed') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('ld') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('pass') }}</td>
                <td class="border px-2 py-4">{{ collect($data)->sum('permission') }}</td>
                <td class="border px-2 py-4">
                    {{
                        collect($data)->sum(fn ($row) =>
                            $row['present'] + $row['absent'] + $row['sick_in'] + $row['sick_out'] +
                            $row['ed'] + $row['ld'] + $row['pass'] + $row['permission']
                        )
                    }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- summary -->
    <div class="mt-8">
        <div class="flex flex-col justify-start items-start font-semibold">
            <span>Summary</span>
            <span>Male:____</span>
            <span>Female: ____</span>
        </div>
        
        <div class="mt-5">
            <h2 class="uppercase font-semibold">other particulars by identity</h2>
            <div class="grid grid-cols-4 justify-items-between items-center mt-2 gap-x-32">
                <div>
                    <span class="uppercase">A: Absent</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
                <div>
                    <span class="uppercase">B: sick in</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
                <div>
                    <span class="uppercase">C: sick out</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
                <div>
                    <span class="uppercase">d: ed</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
            </div>

            <div class="grid grid-cols-4 justify-items-between items-center mt-3 gap-x-32">
                
                <div>
                    <span class="uppercase">e: ld</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
                <div>
                    <span class="uppercase">f: permission</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
                <div>
                    <span class="uppercase">g: special duty</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
                <div>
                    <span class="uppercase">h: pass</span>
                    <ol>
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center items-end uppercase mt-8 w-full mb-8">
            <h2 class="font-semibold">signature</h2>
            <div class="flex flex-col gap-y-3 text-sm mt-3">
                <span>sir major: ____________</span>
                <span>officer on duty: ___________</span>
                <span>chief instructor: ___________</span>
            </div>
        </div>

        <div class="flex justify-end items-end">
            <button class="w-fit h-10 px-4 rounded-md bg-orange-600 hover:border-2 hover:border-orange-600 hover:bg-white transition-all duration-500 ease-in uppercase text-xs text-white hover:text-black cursor-pointer flex items-center gap-2">
                <i class="fas fa-download"></i>
                download report
            </button>
        </div>


    </div>

@endsection
