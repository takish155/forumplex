@props(["user", "tab" => "questions"])

@php
    $params = [
        "locale" => app()->getLocale(),
        "user" => $user,
    ];
@endphp

<div class="md:w-[65%] mx-auto">
  <section class="py-10 flex justify-around items-center">
    <div class="flex items-center gap-4 mb-3">
      <div class="avatar">
          <div class="w-24 rounded-full">
            <img src="{{ $user->avatar ? asset($user->avatar) : 'https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp' }}" />
          </div>
       </div>
       <div>
         <h2 class="text-xl font-bold">{{ $user->username }}</h2>
         <p class="text-sm flex gap-2 items-center">
            <i class="fa fa-birthday-cake"></i> {{ $user->created_at->format("F d, Y") }}
         </p>
         <p class="text-sm flex gap-2 items-center">
          <i class="fa-solid fa-lightbulb"></i> {{ __("users.answered", ["count" => $user->answers->count()]) }}
         </p>
         <p class="text-sm flex gap-2 items-center">
          <i class="fa-solid fa-thumbs-up"></i> {{ __("users.voted", ["voted" => $user->votesOnQuestions->count() + $user->votesOnAnswers ->count() ]) }}
         </p>
       </div>
    </div>
    <div>
      @can("update", $user)
        <a href="{{ route('user.edit', $params) }}" class="btn btn-sm btn-primary">{{ __("users.editProfile") }}</a>
      @endcan
    </div>
  </section>
  <section class="mx-auto mb-24">
        <div role="tablist" class="tabs tabs-lifted">
            <a href="{{ route('user.show', $params) }}" role="tab" class="tab {{ $tab === "questions" ? "tab-active" : ""}}">{{ __("users.Questions") }}</a>
            <a href="{{ route('user.insight', $params) }}" role="tab" class="tab {{ $tab === "insight" ? "tab-active" : ""}}">{{ __("users.insights") }}</a>
            <a href="{{ route('user.voted', $params) }}" role="tab" class="tab {{ $tab === "voted" ? "tab-active" : ""}}">{{ __("users.votedQuestions") }}</a>
        </div>
    {{ $slot }}
  </section>
</div>