@props(["question" => null, "method" => "POST"])

@php
    $locale = app()->getLocale();
@endphp

<form enctype="multipart/form-data" method="POST" action="{{ $method === "POST" ? route('question.store', $locale) :route('question.update', [
                'locale' => $locale,
                'question' => $question,
            ])}}">
    <!-- Be present above all else. - Naval Ravikant -->
    @csrf
    @method($method)

    <x-input-container :required="true" for="title" label="{{ __('question.questionTitle') }}">
        <input value="{{ old('title') ?? $question->question_title ??  "" }}" min="3" max="50" required placeholder="{{ __('question.titleHint') }}" name="title" id="title" class="input w-full input-bordered input-sm" />
    </x-input-container>
    <x-input-container :required="true" for="description" label="{{ __('question.questionDescription') }}">
        <textarea min="3" max="1000" required placeholder="{{ __('question.descriptionHint') }}" name="description" id="description" class="input h-48 w-full input-bordered">{{ old('description') ?? $question->question_description ?? "" }}</textarea>
    </x-input-container>
    <x-input-container for="image" label="{{ __('question.questionImage') }}">
        <input type="file" name="image" class="file-input file-input-sm w-full max-w-xs" />    
    </x-input-container>

    <div class="flex justify-end gap-3">
        @if($question)
            <a href="{{ route('question.show', [
                'locale' => $locale,
                'question' => $question,
            ]) }}">
                <button type="button"  class="btn btn-outline btn-sm">
                    {{ __('question.cancel') }}
                </button>
            </a>
        @endif
        <button class="btn btn-primary btn-sm">{{ __('question.submit') }}</button>
    </div>
</form>