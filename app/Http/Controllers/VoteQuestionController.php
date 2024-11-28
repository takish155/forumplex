<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionVoteRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class VoteQuestionController extends Controller
{
    // @desc    Vote a question 
    // @route   POST /{locale}/questions/{question}/vote
    public function store(StoreQuestionVoteRequest $req, String $_, Question $question): RedirectResponse
    {
        $validated = $req->validated();

        if ($question->isVotedSame($validated["is_helpful"])) {
            $question->voters()->where("user_id", auth()->user()->id)
                ->delete();
            return redirect()->back()->with("success", __("question.deletedVoteSuccess"));
        }

        $question->voters()->create($validated);

        return redirect()->back()->with("success", $validated["is_helpful"] ? __("question.upvotedQuestion") : __("question.downvotedQuestion"));
    }
}
