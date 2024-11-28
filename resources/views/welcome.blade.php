<x-app-layout>
  <section class="w-[95%] mx-auto pt-5 mb-12">
    <h2 class="text-xl font-medium">{{ __("index.unasweredQuestions") }}</h2>
    <p class="text-sm mb-7">{{ __("index.unansweredQuestionDescription")}}</p>
    @foreach($unansweredQuestions as $question)
      <x-question-card  :question="$question" />
    @endforeach
  </section>
  <div class="divider"></div>
  <section class="w-[95%] mx-auto pt-5 mb-12">
    <h2 class="text-xl font-medium">{{ __("index.unasweredQuestions") }}</h2>
    <p class="text-sm mb-7">{{ __("index.unansweredQuestionDescription")}}</p>

  </section>
  <div class="divider"></div>
  <section class="w-[95%] mx-auto pt-5 mb-12">
    <h2 class="text-xl font-medium">{{ __("index.unasweredQuestions") }}</h2>
    <p class="text-sm mb-7">{{ __("index.unansweredQuestionDescription")}}</p>
 
  </section>
</x-app-layout>