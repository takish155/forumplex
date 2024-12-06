<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * @desc    Shows bunch of users based on question count
     * @route   GET /{locale}/users
     */
    public function index(string $_): View
    {
        $users = User::paginate(10);

        return view("users.index", compact("users"));
    }

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

    /**
     * @desc    Shows a view for editing user's profile
     * @route   GET /{locale}/users/1/edit
     */
    public function edit(string $_, User $user): View
    {
        $this->authorize("update", $user);

        return view("users.edit", compact("user"));
    }

    /**
     * @desc    Updates user's profile
     * @route   PUT /{locale}/users/1
     */
    public function update(UpdateUserRequest $request, string $_, User $user): RedirectResponse
    {
        $this->authorize("update", $user);

        $validated = $request->validated();

        if ($request->hasFile("image")) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            $path = $request->file("image")->store("user_avatars", "public");
            $user->update([
                "avatar" => $path
            ]);
        }

        $user->update([
            "about" => $validated["about"]
        ]);

        return redirect()->back()->with("success", __("users.profileUpdatedSuccess"));
    }
}
