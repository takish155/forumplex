<x-app-layout :loadRecentQuestions="true" title="{{ __('users.meta.title.voted', ['user' => $user->username])}}">
  <x-user-layout :user="$user" tab="voted">
        <section>
          @foreach($votes as $votedQuestion)
            @php
              $isVoted = $votedQuestion->votedQuestion->author->username;
              $authorUsername = $votedQuestion->votedQuestion->author->username;
            @endphp
            <div class="card card-body bg-base-100 shadow-lg mb-7">
              <p class="text-xs">
                @if($isVoted)
                  <i class="fa-solid fa-thumbs-up"></i>
                @else
                  <i class="fa-solid fa-thumbs-down"></i>
                @endif
                {{ $isVoted ? __("users.upvotedThisQuestion", [
                "user" => $authorUsername
              ]) : 
              __("users.downvotedThisQuestion", [
                "user" => $authorUsername
              ])
              }}</p>
              <x-mini-question-card :question="$votedQuestion->votedQuestion" />
            </div>
          @endforeach
        </section>
        {{ $votes->links() }}
  </x-user-layout>
</x-app-layout>