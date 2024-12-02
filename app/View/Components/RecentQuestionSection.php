<?php

namespace App\View\Components;

use App\Models\Question;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentQuestionSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $recentQuestions = Question::latest()
            ->take(3)
            ->get();

        return view('components.recent-question-section', compact("recentQuestions"));
    }
}
