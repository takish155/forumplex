<x-app-layout title="{{ __('question.meta.title.edit', ['title' => $question->question_title])}}">
  <section class="w-[95%] max-w-[600px] mx-auto mt-10">
    <h2 class="text-2xl font-medium">{{ __("question.editQuestion") }}</h2>
    <p class="mb-4 font-light">{{ __("question.editQuestionDescription") }}</p>
    <x-ask-form :question="$question" method="PUT" />
  </section>
</x-app-layout>