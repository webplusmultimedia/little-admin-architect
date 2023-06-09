@php use Webplusmultimedia\LittleAdminArchitect\LittleAdminArchitect; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @livewireStyles

    @stack('scripts')
    <!-- Scripts -->
    <link rel="stylesheet" href="{{ route('little-admin.page.assets','app.css') }}">

</head>
<body class="bg-gray-100 min-h-screen">
<div class="flex min-h-screen items-center justify-center bg-gradient-to-r from-primary-100">
    <div class="w-screen max-w-md p-5 grid gap-1 border border-gray-300 rounded-2xl bg-white ">
        {{ $slot }}
    </div>
</div>

@livewireScripts
<script defer src="{{ route('little-admin.page.assets','app.js') }}"></script>
</body>
</html>
