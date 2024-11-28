<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Question;
use App\Models\User;
use App\Models\AnswerVote;


class Answer extends Model
{
    use HasFactory;

    protected $table = "answers";

    protected $fillable = [
        "user_id",
        "question_id",
        "message",
        "answer_image_path",
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function answeredQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, "question_id", "id");
    }

    // Get vote count
    public function voteCount(): int
    {
        return $this->voters()->where("is_helpful", "1")->count() - $this->voters()->where("is_helpful", "0")->count();
    }

    // Relate to AnswerVote
    public function voters(): HasMany
    {
        return $this->hasMany(AnswerVote::class, "answer_id", "id");
    }

    // Checks if voted the same
    public function isVotedSame($answer)
    {
        if (!auth()->user()) {
            return false;
        }

        return $this->voters()->where("user_id", auth()->user()->id)
            ->where("is_helpful", $answer)
            ->exists();
    }

    // Check if is upvoted
    public function upvoted()
    {
        if (!auth()->user()) {
            return false;
        }

        return $this->voters()->where("user_id", auth()->user()->id)
            ->where("is_helpful", true)
            ->exists();
    }

    // Check if is downvoted
    public function downvoted()
    {
        if (!auth()->user()) {
            return false;
        }

        return $this->voters()->where("user_id", auth()->user()->id)
            ->where("is_helpful", false)
            ->exists();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
