@php
  $locale = app()->getLocale();

  $params = [
        "locale" => $locale,
        "question" => $question,
    ];

  $orderedAnswers = $question->answers()
    ->select('answers.*')
    ->orderByRaw('(SELECT COUNT(*) FROM answer_votes WHERE answer_votes.answer_id = answers.id AND is_helpful = 1) DESC')
    ->paginate(10);
@endphp


<x-app-layout>
  @if($question->is_solved) 
    <div role="alert" class="alert text-sm alert-info w-[90%] mx-auto my-5 text-white">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        class="h-6 w-6 shrink-0 stroke-current">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span>{{ __("question.solved") }}</span>
    </div>
  @endif

  <div class="w-[95%] mx-auto mt-5 max-w-[600px]">
    <section class="mb-10">
      <x-user-info-card :user="$question->author" />
      <div class="mb-10">
        <h2 class="text-2xl font-me dium">{{ $question->question_title }}</h2>
        <p class="mb-3">{{ $question->question_description }}</p>
        @if($question->question_image_path)
                <div class="w-full h-auto mb-2">
                    <img src="{{ asset($question->question_image_path) }}" alt="Question Image" class="w-full h-auto object-cover rounded-lg" />
                </div>
        @endif
        <x-question-actions :question="$question" :isMain="true" />
      </div>
      @if(!$question->is_solved)
      <form enctype="multipart/form-data"  method="POST" action="{{ route('answer.store', $params) }}">
        @csrf
        <textarea name="message" min="3" max="1000" required class="mb-2 input input-bordered w-full h-20" placeholder="{{ __('question.shareYourInsights') }}">{{ old('message') }}</textarea>
        <x-input-container for="image" label="{{ __('question.imageForYourAnswer') }}" >
          <input name="image" type="file" class="file-input file-input-sm   w-full" /> 
        </x-input-container>
        <div class="flex justify-end">
          <button class="btn btn-primary btn-sm">{{ __("question.comment") }}</button>
        </div>
      </form>
      @endif
    </section>
    @forelse($orderedAnswers as $answer)
      <x-answer-card :answer="$answer" :question="$question" />
    @empty
      @if(!$question->is_solved)
        <p class="text-sm text-gray-500">{{ __("question.noAnswersYet") }}</p>
      @endif
    @endforelse
    {{ $orderedAnswers->links() }}
  </div>
</x-app-layout>