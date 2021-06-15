<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href='{{ asset("/vendor/payzone/style.css") }}'/>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100" id="app">
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="{{ asset("images/logo.png") }}" alt="{{ config('app.name') }}">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    @yield('header')
                </h2>
            </div>
            @yield('content')
        </div>
    </div>
</div>
@yield('scripts')
</body>
</html>
