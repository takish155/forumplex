<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/{locale}', [HomeController::class, "index"])
    ->name("index");

Route::get("/{locale}/questions/{question}", [QuestionController::class, "show"])
    ->name("question.show");


Route::middleware([GuestMiddleware::class])->group(function () {
    Route::get("/{locale}/login", [LoginController::class, "index"])->name("login");
    Route::post("/{locale}/login", [LoginController::class, "store"])->name("login.store");
});

Route::middleware([AuthMiddleware::class])->group(function () {
    // Answers
    Route::post("/{locale}/questions/{question}/answers", [AnswerController::class, "store"])
        ->name("answer.store");
    Route::delete("/{locale}/answers/{answer}", [AnswerController::class, "destroy"])
        ->name("answer.destroy");

    Route::post("/{locale}/answers/{answer}/votes", [VoteAnswerController::class, "store"])
        ->name("answer-vote.store");

    // Questions
    Route::get("/{locale}/questions/create", [QuestionController::class, "create"])
        ->name("question.create");
    Route::post("/{locale}/questions", [QuestionController::class, "store"])
        ->name("question.store");
    Route::delete("/{locale}/questions/{question}", [QuestionController::class, "destroy"])
        ->name("question.destroy");

    // QuestionVotes
    Route::post("/{locale}/questions/{question}/vote", [VoteQuestionController::class, "store"])
        ->name("question-vote.store");

    Route::get("/{locale}/logout", [LoginController::class, "destroy"])
        ->name("logout");

    Route::get("/{locale}/dashboard", [DashboardController::class, "index"])
        ->name("dashboard");

    Route::get('/{locale}/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/{locale}/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/{locale}/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
