@props([
    "question",
    "needMargin" => true
])

@php
    $locale = app()->getLocale();

    $voteParam = [
        "locale" => $locale,
        "question" => $question,
    ];
@endphp


<section class="hover:bg-base-200 transition-colors duration-200 ease-in-out  w-full card card-body bg-base-100 shadow-xl py-12 {{ $needMargin ? 'mb-14' : 'mb-3'}}">
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <x-user-info-card :user="$question->author" />
    <a href="{{ route('question.show', $voteParam) }}">
            <div class="mb-2">
                <h2 class="card-title">{{ $question->question_title }}</h2>
                <p class="mb-2">{{ substr($question->question_description, 0, 300)  }}@if(strlen($question->question_description) >= 300)...@endif</p>
                @if($question->question_image_path)
                    <div class="w-full">
                        <img src="{{ $question->question_image_path }}" alt="Question Image" class="w-full h-auto object-cover rounded-lg" />
                    </div>
                @endif    
            </div>
    </a>
    <x-question-actions :question="$question" />
</section>