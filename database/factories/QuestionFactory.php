<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "user_id" => "1",
            "question_title" => $this->faker->sentence() . "?",
            "question_description" => $this->faker->paragraphs(5, true)
        ];
    }
}

// php artisan db:seed --class=RandomQuestionSeeder