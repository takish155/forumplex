@php
    $locale = app()->getLocale();
@endphp

<header class="z-50 navbar bg-base-100 w-full justify-around top-0 sticky border-b-2">
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->

    <h1 class="font-bold md:text-2xl text-lg"><a href="{{ route('index', $locale) }}">Forumplex</a><h1>
    <nav class="flex gap-3 items-center">
        @auth
            <a href="{{ route('question.create', $locale) }}"><button class="btn btn-primary btn-sm">{{ __("index.askSomething") }}</button></a>   
            <x-account-bar />
        @else
            <a href="{{ route('login', $locale) }}"><button class="btn btn-primary btn-sm">{{ __("index.login") }}</button></a>
        @endauth
    </nav>
</header>