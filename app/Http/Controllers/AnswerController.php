<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    use AuthorizesRequests;

    // @desc    Stores the answer
    // @route   POST /{locale}/questions/{question}/answers
    public function store(StoreAnswerRequest $req, string $_, Question $question): RedirectResponse
    {
        if ($question->is_solved) {
            return redirect()->back()->with("error", __("question.solved"));
        }

        $validated = $req->validated();

        if ($req->hasFile("image")) {
            $path = $req->file("image")->store("answer_images", "public");

            $validated["answer_image_path"] = $path;
        };

        $question->answers()->create($validated);

        return redirect()->back()->with("success", __("question.insightPosted"));
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @desc    Deletes the question
     * @route   DELETE /{locale}/answers/{answer}
     */
    public function destroy(Request $req, string $_, Question $__, Answer $answer): RedirectResponse
    {
        $this->authorize("delete", $answer);

        $answer->delete();

        return redirect()->back()->with("success", __("question.deleteAnswerSuccess"));
    }
}
