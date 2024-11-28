<?php

namespace App\Providers;

use App\Models\Answer;
use App\Models\Question;
use App\Policies\AnswerPolicy;
use App\Policies\QuestionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [Question::class => QuestionPolicy::class, Answer::class => AnswerPolicy::class];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
}
