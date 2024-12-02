<x-app-layout :loadRecentQuestions="true">
  <x-user-layout :user="$user" tab="voted">
        <section>
          @foreach($votes as $votedQuestion)
            <div class="card card-body bg-base-100 shadow-lg mb-7">
              <p class="text-xs">{{ $votedQuestion->is_helpful ? __("users.upvotedThisQuestion", [
                "user" => $votedQuestion->votedQuestion->author->username
              ]) : 
              __("users.downvotedThisQuestion", [
                "user" => $votedQuestion->votedQuestion->author->username
              ])
              }}</p>
              <x-mini-question-card :question="$votedQuestion->votedQuestion" />
            </div>
          @endforeach
        </section>
        {{ $votes->links() }}
  </x-user-layout>
</x-app-layout>