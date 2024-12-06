<x-app-layout title="{{__('users.meta.title.index')}}">
  @foreach ($users as $user)
    <section class="card card-body bg-base-100 shadow-lg w-[95%] flex-row">
      <img class="w-14 h-14 rounded-full" src="{{ $user->avatar ? asset($user->avatar) : "https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" }}" />
      <div>
        <h3 class="font-medium text-md"><a class="hover:underline" href="{{ route('user.show', ['locale' => app()->getLocale(), 'user' => $user]) }}">{{ "@" . $user->username }}</a></h3>
        <p class="text-sm"><i class="fa-solid fa-message"></i> {{ __("users.questionCount", ["count" => $user->questions()->count()]) }}</p>
        <p class="text-sm"><i class="fa-solid fa-lightbulb"></i> {{ __("users.insightCount", ["count" => $user->answers()->count()]) }}</p>
      </div>
    </section>
  @endforeach
  {{ $users->links() }}
</x-app-layout>