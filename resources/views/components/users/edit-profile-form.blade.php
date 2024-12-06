@props(['user'])

<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<form enctype="multipart/form-data" method="POST" action="{{ route("user.update", ["locale" => app()->getLocale(), "user" => $user]) }}">
    @csrf
    @method('PUT')

    <x-input-container for="image" label="{{ __('users.avatar') }}">
        <div class="flex gap-4 items-center">
            <img class="w-16 rounded-full" src="{{ asset($user->avatar) }}" />
            <input type="file" name="image" class="file-input file-input-sm w-full max-w-xs" />    
        </div>
    </x-input-container>
    <x-input-container for="about" label="{{ __('users.about') }}">
           <textarea max="1000" placeholder="{{ __('users.aboutHint') }}" name="about" id="about" class="input h-48 w-full input-bordered">{{ old('about') ?? $user->about ?? "" }}</textarea>
    </x-input-container>
    <div>
        <button class="btn btn-primary btn-sm">{{ __('users.update') }}</button>
    </div>
</form>