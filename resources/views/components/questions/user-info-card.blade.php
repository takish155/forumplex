<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
@props(['user'])

@php
  $params = [
    "locale" => app()->getLocale(),
    "user" => $user
  ]
@endphp

<div class="flex items-center gap-2 mb-3">
    <div class="avatar">
        <div class="w-7 rounded-full">
          <img src="{{ $user->avatar ? asset($user->avatar) : 'https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp' }}" />
        </div>
     </div>
     @auth
      <h4 class="text-sm"><a class="hover:underline pointer" href="{{ route('user.show', $params) }}">{{$user->username === auth()->user()->username ? __("question.you") : $user->username}}</a></h4>
     @else
      <h4 class="text-sm"><a class="hover:underline pointer" href="{{ route('user.show', $params) }}">{{ $user->username }}</a></h4>
      @endauth
</div>