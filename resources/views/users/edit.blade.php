<x-app-layout title="{{ __('users.meta.title.edit', ['user' => $user->username])}}">
    <section class="w-[95%] max-w-[600px] mx-auto mt-10">
      <h2 class="text-2xl font-medium">{{ __("users.editProfile") }}</h2>
      <p class="mb-4 font-light">{{ __("users.editProfileDescription") }}</p>
      <x-edit-profile-form :user="$user" />
    </section>
</x-app-layout>