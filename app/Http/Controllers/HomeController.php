<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\DailyTotal;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the dashboard with charts using daily_totals table.
     */
    public function index(Request $request)
    {
        $students_count = Student::count();
        $users_count = User::count();

        // Get selected month or use current
        $month = $request->get('month', now()->format('Y-m'));
        [$year, $monthNum] = explode('-', $month);

        // Get data from daily_totals for visualization
        $trendData = DailyTotal::selectRaw('
                report_date as date,
                ed,
                absent,
                sick_out,
                sick_in,
                permission
            ')
            ->whereYear('report_date', $year)
            ->whereMonth('report_date', $monthNum)
            ->orderBy('report_date')
            ->get();

        return view('admin.dashboard', [
            'students_count' => $students_count,
            'users_count' => $users_count,
            'dates' => $trendData->pluck('date'),
            'edCounts' => $trendData->pluck('ed'),
            'absentCounts' => $trendData->pluck('absent'),
            'sickOutCounts' => $trendData->pluck('sick_out'),
            'sickInCounts' => $trendData->pluck('sick_in'),
            'permissionCounts' => $trendData->pluck('permission'),
            'selectedMonth' => $month,
        ]);
    }

    /**
     * Show the welcome page.
     */
    // public function showWelcomePage()
    // {
    //     return view('welcome');
    // }

      public function showWelcomePage()
    {
        return view('login');
    }


    //   public function showWelcomePage()
    // {
    //     return view('loginems');
    // }


    // public function login()
    // {
    //     return view('login');
    // }

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
