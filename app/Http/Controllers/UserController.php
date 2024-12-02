<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * @desc    Shows bunch of users based on question count
     * @route   GET /{locale}/users
     */
    public function index(string $_): View {}

    /**
     * @desc    Shows a certain user page
     * @route   GET /{locale}/users/{user}
     */
    public function show(string $_,  User $user): View
    {
        $questions = $user->questions()->paginate(10);

        return view("users.show", compact("questions", "user"));
    }

    /**
     * @desc    Shows users's inisghts
     * @route   GET /{locale}/users/{user}/insights
     */
    public function showUserInsights(string $_,  User $user): View
    {
        $answers = $user->answers()->paginate(10);

        return view("users.insight", compact("user", "answers"));
    }

    /**
     * @desc    Shows voted questions or answers by user 
     * @route   GET /{locale}/users/{user}/insights
     */
    public function showUserVotedDiscussion(string $_,  User $user): View
    {
        $votes = $user->votesOnQuestions()->paginate(10);

        return view("users.voted", compact("user", "votes"));
    }
}
