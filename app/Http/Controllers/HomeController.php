<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function dashboard() {
        $users_count = User::count();
        //dd($users_count);
        return view('admin.dashboard', compact('users_count'));
    }

    public function dashboardHome() {
        return view('admin.dashboardHome');
    }

    public function recommendation() {
        return view('admin.recommendation');
    }

    public function reportbasicfiremanship() {
        return view('admin.reportbasicfiremanship');
    }

    public function reportinservice() {
        return view('admin.reportinservice');
    }

    public function studentbasicfiremanship() {
        return view('admin.studentbasicfiremanship');
    }

    public function studentinservice() {
        return view('admin.studentinservice');
    }

    public function usermanagement() {
        return view('admin.usermanagement');
    }

    public function paradereportbasicfiremanship() {
        return view('admin.paradereportbasicfiremanship');
    }
    public function paradereportinservice() {
        return view('admin.paradereportinservice');
    }
}
