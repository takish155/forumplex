<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionVoteRequest;
use App\Models\Answer;
use Illuminate\Http\RedirectResponse;

class VoteAnswerController extends Controller
{
    // @desc    Vote an answer 
    // @route   POST /{locale}/questions/{question}/votes/{answer}
    public function store(StoreQuestionVoteRequest $req, String $_,  Answer $answer): RedirectResponse
    {
        $validated = $req->validated();

        if ($answer->isVotedSame($validated["is_helpful"])) {
            $answer->voters()->where("user_id", auth()->user()->id)
                ->delete();
            return redirect()->back()->with("success", __("question.deletedVoteSuccess"));
        }

        $answer->voters()->create($validated);

        return redirect()->back()->with("success", $validated["is_helpful"] ? __("question.upvotedAnswer") : __("question.downvotedAnswer"));
    }
}
