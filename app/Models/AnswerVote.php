<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\Question;

class AnswerVote extends Model
{
    use HasFactory;

    protected $table = "answer_votes";

    protected $fillable = [
        "user_id",
        "answer_id",
        "is_helpful"
    ];

    // Relate to User
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    // Relate to Answer
    public function votedAnswer(): BelongsTo
    {
        return $this->belongsTo(Question::class, "answer_id", "id");
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;

            self::where("answer_id", $model->answer_id)
                ->where("user_id", $model->user_id)
                ->delete();
        });
    }
}
