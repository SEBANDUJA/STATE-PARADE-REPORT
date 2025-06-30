<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $students_count = Student::count();
    $users_count = User::count();

    $month = $request->get('month', now()->format('Y-m'));
    [$year, $monthNum] = explode('-', $month);

    $trendData = Student::selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date,
            SUM(ed) as ed_count,
            SUM(absent) as absent_count,
            SUM(sick_out) as sick_out_count")
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $monthNum)
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    return view('admin.dashboard', [
        'students_count' => $students_count,
        'users_count' => $users_count,
        'dates' => $trendData->pluck('date'),
        'edCounts' => $trendData->pluck('ed_count'),
        'absentCounts' => $trendData->pluck('absent_count'),
        'sickOutCounts' => $trendData->pluck('sick_out_count'),
        'selectedMonth' => $month,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function showWelcomePage()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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