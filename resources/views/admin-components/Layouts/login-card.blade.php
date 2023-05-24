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
    <link rel="stylesheet" href="{{ route('little-admin.page.assets.style','app.css') }}">

</head>
<body class="bg-gray-100">
<div class="flex w-screen h-screen items-center justify-center">
    <div class="md:w-2/5 md:min-w-fit min-w-full mx-auto p-5 grid gap-1 border border-gray-300 rounded-md bg-white ">
        {{ $slot }}
    </div>
</div>

@livewireScripts
<script defer src="{{ route('little-admin.page.assets.js','app.js') }}"></script>
</body>
</html>
