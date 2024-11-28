<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    //
    public function index(): View
    {
        $unansweredQuestions = Question::where("is_solved", false)
            ->take(5)
            ->get();

        return view('welcome', compact("unansweredQuestions"));
    }
}
