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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
}
