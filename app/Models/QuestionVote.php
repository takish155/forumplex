<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Question;
use App\Models\User;

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
        return $this->belongsTo(User::class, "user_id", "id");
    }

    // Relate to Questions
    public function votedQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, "question_id", "id");
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;

            self::where("question_id", $model->question_id)
                ->where("user_id", $model->user_id)
                ->delete();
        });
    }
}
