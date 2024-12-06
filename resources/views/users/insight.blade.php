<x-app-layout :loadRecentQuestions="true" title="{{ __('users.meta.title.insights', ['user' => $user->username]) }}">
  <x-user-layout :user="$user" tab="insight">
    @foreach($answers as $answer)
          <x-question-card :question="$answer->answeredQuestion" :needMargin="false" />
          <x-answer-card :answer="$answer" />
    @endforeach
    {{ $answers->links() }}
  </x-user-layout>
</x-app-layout>