<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "username",
        "avatar",
        "about"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Realtion to questions
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    // Realtion to answers
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    // Realtion to question_votes
    public function votesOnQuestions(): HasMany
    {
        return $this->hasMany(QuestionVote::class);
    }

    // Realtion to answer_votes
    public function votesOnAnswers(): HasMany
    {
        return $this->hasMany(AnswerVote::class);
    }
}
