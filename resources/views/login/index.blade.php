<x-app-layout>
  <a></a>
  <section class="w-[95%] max-w-[500px] mx-auto mt-10 py-10">
    <h2 class="text-center mb-2 text-xl font-bold">{{ __("auth.login") }}</h2>
    <p class="text-center mb-6">{{ __("auth.loginDescription") }}</p>
    <form method="POST" action="{{ route('login.store', app()->getLocale()) }}" class="w-[90%] mx-auto">
      @csrf
      <div class="mb-10">
        <x-input-container for="username" label="{{ __('auth.username') }}">
          <input value="{{ old('username') }}" placeholder="user12345" type="text" id="username" name="username" class="input w-full input-primary input-bordered" />  
        </x-input-container>
        <x-input-container for="password" label="{{ __('auth.password') }}">
          <input placeholder="********" type="password" id="password" name="password" class="input w-full input-primary input-bordered" />  
        </x-input-container>
      </div>

      <button class="btn btn-primary w-full mx-auto">{{ __("auth.login") }}</button>
    </form>
  </section>
</x-app-layout>