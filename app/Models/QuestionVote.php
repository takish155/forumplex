<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionVote extends Model
{
    use HasFactory;

    protected $table = "question_votes";

    protected $fillable = [
        "user_id",
        "question_id",
        "is_helpful"
    ];

    // Relate to user
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relate to Questions
    public function answeredQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
