<x-app-layout :loadRecentQuestions="true">
    <section class="md:w-[65%] mx-auto pt-5 mb-12">
      @foreach($questions as $question)
        <x-question-card :question="$question" />
      @endforeach
      {{ $questions->links() }}
    </section>
</x-app-layout>