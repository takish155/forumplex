<x-app-layout :loadRecentQuestions="true" title="{{__('users.meta.title.show', ['user' => $user->username])}}">
    <x-user-layout :user="$user">
        @foreach($questions as $question)
          <x-question-card :question="$question" />
        @endforeach
        {{ $questions->links() }}
    </x-user-layout>
</x-app-layout>