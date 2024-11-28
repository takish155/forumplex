

<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
@props(['user'])

<div class="flex items-center gap-2 mb-3">
    <div class="avatar">
        <div class="w-7 rounded-full">
          <img src="{{ $user->avatar_image_path ?? 'https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp' }}" />
        </div>
     </div>
     @auth
      <h4 class="text-sm">{{ $user->username === auth()->user()->username ? __("question.you") : $user->username}}</h4>
     @else
      <h4 class="text-sm">{{ $user->username }}</h4>
      @endauth
</div>