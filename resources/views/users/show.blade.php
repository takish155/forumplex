<x-app-layout :loadRecentQuestions="true">
    <x-user-layout :user="$user">
        @foreach($questions as $question)
          <x-question-card :question="$question" />
        @endforeach
        {{ $questions->links() }}
    </x-user-layout>
</x-app-layout>