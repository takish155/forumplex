<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class QuestionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view("questions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile("image")) {
            $path = $request->file("image")->store("question_images", "public");

            $validated["image"] = $path;
        };

        $question = new Question([
            "question_title" => $validated["title"],
            "question_description" => $validated["description"],
            "question_image_path" => $validated["image"] ?? null,
        ]);

        $question->save();

        return redirect("index.locale")->with("success", __("question.questionPostSuccess"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $_, Question $question): View
    {
        return view("questions.index", compact("question"));
    }

    /**
     * @desc    Loads the edit form for editing the question
     * @route   GET /{locale}/questions/{question}/edit
     */
    public function edit(string $_, Question $question): View
    {
        $this->authorize("update", $question);

        return view("questions.edit", compact("question"));
    }

    /**
     * @desc    Updates the row of question specified
     * @route   PUT /{locale}/questions/{question}
     */
    public function update(StoreQuestionRequest $request, string $_, Question $question): RedirectResponse
    {
        $this->authorize("update", $question);
        $validated = $request->validated();

        if ($request->hasFile("image")) {
            $path = $request->file("image")->store("question_images", "public");

            $question->update(["question_image_path", $path]);
        };

        $question->update([
            "question_title" => $validated["title"],
            "question_description" => $validated["description"]
        ]);

        return redirect()->back()->with("success", __("question.questionUpdateSuccess"));
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @desc    Deletes the question
     * @route   DELETE /{locale}/questions/{question}
     */
    public function destroy(Request $req, string $_, Question $question): RedirectResponse
    {
        $this->authorize("delete", $question);

        $question->delete();

        return redirect()->route("index", app()->getLocale())->with("success", __("question.deleteQuestionSuccess"));
    }

    /**
     * @desc    Marks the question as solved
     * @route   POST /{locale}/questions/{question}/mark_as_solved
     */
    public function markAsSolved(string $_, Question $question): RedirectResponse
    {
        $this->authorize("update", $question);

        if ($question->is_solved) {
            $question->update(['is_solved' => false]);

            return redirect()->back()->with("success", __('question.markedAsUnsolvedSuccess'));
        }

        $question->update(["is_solved" => true]);

        return redirect()->back()->with("success", __("question.markedAsSolvedSuccess"));
    }
}
