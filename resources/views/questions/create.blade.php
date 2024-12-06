<x-app-layout title="{{ __('question.meta.title.create') }}">
  <section class="w-[95%] max-w-[600px] mx-auto mt-10">
    <h2 class="text-2xl font-medium">{{ __("question.askSomething") }}</h2>
    <p class="mb-4 font-light">{{ __("question.askSomethingDescription") }}</p>
    <x-ask-form />
  </section>
</x-app-layout>