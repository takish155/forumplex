@props(["loadRecentQuestions" => false, "title" => "Forumplex", "description"])

<!DOCTYPE html>
<html data-theme="light"  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="grid">

            <!-- Page Heading -->
            <x-header />

            <!-- Page Content -->
            <x-side-nav />
            <main class="min-h-screen lg:ml-56 pt-5">
                <div class="flex justify-center w-[95%] mx-auto space-around gap-4 flex-wrap">
                    {{-- Display alert message --}}
                    @if(session()->has("success"))
                        <x-alert type="success" message="{{ session('success') }}" />
                    @else 
                        <x-alert type="error" message="{{ session('error') }}" />
                    @endif
                    {{ $slot }}
                    @if($loadRecentQuestions)
                        <x-recent-question-section />
                    @endif
                </div>
            </main>
            <x-footer />
        </div>
    </body>
</html>
