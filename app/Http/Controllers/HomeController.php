<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function dashboardHome() {
        return view('admin.dashboardHome');
    }

    public function recommendation() {
        return view('admin.recommendation');
    }

    public function reportFiremanship() {
        return view('admin.reportFiremanship');
    }
}
