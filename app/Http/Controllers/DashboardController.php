<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    // @desc    Loads the view of dashboard
    // @route   GET /dashboard
    public function index(): View
    {
        return view("dashboard");
    }
}
