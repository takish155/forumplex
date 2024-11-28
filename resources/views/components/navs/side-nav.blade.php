@php
    $locale = app()->getLocale();

    function checkRoute($route) {
        return request()->is("en" . $route) || request()->is("ja" . $route) ? 'active' : '';
    }
@endphp

<nav class="fixed top-10  left-0 card shadow-lg">
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    <ul class="max-lg:hidden pt-16 menu bg-base-100 w-56 min-h-screen rounded-none">
        <li><a href="{{ route('index', $locale) }}" class="{{ checkRoute('') }} flex"><i class="fa-solid fa-home" aria-hidden="true"></i> {{ __("index.home")}}</a></li>
        <li><a href="{{ route('dashboard', $locale) }}" class="{{ checkRoute('/questions') }}"><i class="fa-solid fa-circle-question" aria-hidden="true"></i> {{ __("index.questions")}}</a></li>
        <li><a href="{{ route('index', $locale) }}" class="{{ checkRoute('/users') }}"><i class="fa-solid fa-gear" aria-hidden="true"></i> {{( __("index.users")) }}</a></li>
    </ul>
</nav>