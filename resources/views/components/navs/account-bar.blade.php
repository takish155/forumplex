@php
    $locale = app()->getLocale();

    $user = auth()->user();
@endphp

<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    <details class="dropdown">
        <summary class="btn m-1">
            <div class="avatar">
                <div class="w-[50px] rounded-full">
                  <img src="{{ $user->avatar ? asset($user->avatar) : "https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"}}" />
                </div>
            </div>
        </summary>
        <ul class="menu dropdown-content bg-base-100 rounded-box z-[1] w-52 p-2 shadow-xl">
          <li class="ml-2 mb-4 text-medium">{{ __("index.greetUser", ["username" => auth()->user()->username ]) }}</li>
          <li><a href="{{ route('dashboard', $locale) }}">{{ __("index.dashboard") }}</a></li>
          <li><a href="{{ route("user.show", ["locale" => $locale, "user" => auth()->user()]) }}">{{ __("index.profile") }}</a></li>
          <li><a>{{ __("index.settings") }}</a></li>
          <li>
            <form method="POST" action="{{ route('logout', $locale) }}">
              @csrf
              <button class="text-red-500">{{ __("index.signOut") }}</button></li>
            </form>
        </ul>
    </details>
</div>