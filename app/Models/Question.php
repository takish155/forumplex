<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\User;
use App\Models\Answer;
use App\Models\QuestionVote;
use phpDocumentor\Reflection\Types\Boolean;

class Question extends Model
{
    use HasFactory;

    protected $table = "questions";

    protected $fillable = [
        "user_id",
        "question_title",
        "question_description",
        "question_image_path",
        "is_solved",
        "helpfull_message_id",
    ];

    // Relate to User
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    // Relate to AnswerVote
    public function voters(): HasMany
    {
        return $this->hasMany(QuestionVote::class, "question_id", "id");
    }

    // Relate To Answers
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, "question_id", "id");
    }

    // Get vote count
    public function voteCount(): int
    {
        return $this->voters()->where("is_helpful", "1")->count() - $this->voters()->where("is_helpful", "0")->count();
    }

    // Check if voted the same question with the same vote
    public function isVotedSame($answer)
    {
        if (!auth()->user()) {
            return false;
        }

        return $this->voters()->where("user_id", auth()->user()->id)
            ->where("is_helpful", $answer)
            ->exists();
    }

    // Check if is voted
    public function upvoted()
    {
        if (!auth()->user()) {
            return false;
        }

        return $this->voters()->where("user_id", auth()->user()->id)
            ->where("is_helpful", true)
            ->exists();
    }

    // Check if is voted
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
