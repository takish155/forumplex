@props([
    "question"
])

@php
    $locale = app()->getLocale();

    $voteParam = [
        "locale" => $locale,
        "question" => $question,
    ];
@endphp


<section class="hover:bg-base-200 cursor-pointer card card-body bg-base-100 shadow-xl max-w-[600px]  mb-10">
        <a href="{{ route('question.show', $voteParam) }}">
        <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
        <x-user-info-card :user="$question->author" />
        <div class="mb-2">
            <h2 class="card-title">{{ $question->question_title }}</h2>
            <p class="mb-2">{{ $question->question_description }}</p>
            @if($question->question_image_path)
                <div class="w-full">
                    <img src="{{ $question->question_image_path }}" alt="Question Image" class="w-full h-auto object-cover rounded-lg" />
                </div>
            @endif    
        </div>
        <x-question-actions :question="$question" />
    </a>
    </section>