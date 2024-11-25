<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $table = "questions";

    protected $fillable = [
        "user_id",
        "question_title",
        "question_description",
        "image_paths",
        "is_solved",
        "helpfull_message_id",
    ];

    // Relate to User
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relate to AnswerVote
    public function voters(): BelongsToMany
    {
        return $this->belongsToMany(QuestionVote::class);
    }

    // Relate To Answers
    public function answers(): BelongsToMany
    {
        return $this->belongsToMany(Answer::class);
    }
}
