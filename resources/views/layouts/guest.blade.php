<!DOCTYPE html>
<html  lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')
    </head>
    <body class="min-h-full bg-gray-200">
        @include('layouts.navigation')

        <div class="font-sans text-gray-900 antialiased" id="app">
            {{ $slot }}
        </div>

        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('scripts')
    </body>
</html>
