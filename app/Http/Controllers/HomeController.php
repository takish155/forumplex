<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\View\View;

class HomeController extends Controller
{
    //
    public function index(): View
    {
        $questions = Question::paginate(10);

        return view('welcome', compact("questions"));
    }
}
