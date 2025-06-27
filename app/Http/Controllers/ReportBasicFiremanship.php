<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportBasicFiremanship extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //current date
        $currentDate = now()->format('l, jS \of F Y'); 

        // Gender summary
        $maleCount = DB::table('students')->where('gender', 'Male')->count();
        $femaleCount = DB::table('students')->where('gender', 'Female')->count();

        //
        // Per company summary data
        $reportData = DB::table('students')
        ->select(
            'company',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(absent) as absent'),
            DB::raw('SUM(sick_in) as sick_in'),
            DB::raw('SUM(sick_out) as sick_out'),
            DB::raw('SUM(ed) as ed'),
            DB::raw('SUM(ld) as ld'),
            DB::raw('SUM(pass) as pass'),
            DB::raw('SUM(permission) as permission')
        )
        ->groupBy('company')
        ->orderBy('company')
        ->get();

    // Compute present and absent for each row
    foreach ($reportData as $row) {
        $row->present = $row->total - $row->absent;
    }

    // Optional: calculate grand totals
    $totals = [
        'present' => $reportData->sum('present'),
        'absent' => $reportData->sum('absent'),
        'sick_in' => $reportData->sum('sick_in'),
        'sick_out' => $reportData->sum('sick_out'),
        'ed' => $reportData->sum('ed'),
        'ld' => $reportData->sum('ld'),
        'pass' => $reportData->sum('pass'),
        'permission' => $reportData->sum('permission'),
        'total' => $reportData->sum('total'),
    ];

    //
    // Lists for Other Particulars (with name + ID)
    $absentList = DB::table('students')->where('absent', 1)->get(['s_id', 'name']);
    $sickInList = DB::table('students')->where('sick_in', 1)->get(['s_id', 'name']);
    $sickOutList = DB::table('students')->where('sick_out', 1)->get(['s_id', 'name']);
    $edList = DB::table('students')->where('ed', 1)->get(['s_id', 'name']);
    $ldList = DB::table('students')->where('ld', 1)->get(['s_id', 'name']);
    $permissionList = DB::table('students')->where('permission', 1)->get(['s_id', 'name']);
    $specialDutyList = DB::table('students')->where('special_duty', 1)->get(['s_id', 'name']);
    $passList = DB::table('students')->where('pass', 1)->get(['s_id', 'name']);
    
    return view('admin.reportbasicfiremanship',['currentDate' => $currentDate], compact(
        'reportData',
         'totals',
         'maleCount',
         'femaleCount',
         'absentList',
         'sickInList',
         'sickOutList',
         'edList',
         'ldList',
         'permissionList',
         'specialDutyList',
         'passList'
        ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.paradereportbasicfiremanship');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
