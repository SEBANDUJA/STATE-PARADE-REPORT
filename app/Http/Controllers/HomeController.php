<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $students_count = Student::count();
        $users_count = User::count();

        // Get selected month from query, default to current
        $month = $request->get('month', now()->format('Y-m'));
        [$year, $monthNum] = explode('-', $month);

        // Get trend data grouped by date for the selected month
        $trendData = Student::selectRaw('DATE(created_at) as date,
                SUM(ed) as ed_count,
                SUM(absent) as absent_count,
                SUM(sick_out) as sick_out_count')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $monthNum)
            ->groupByRaw('DATE(created_at)')
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

    public function showWelcomePage()
    {
        return view('welcome');
    }
}

