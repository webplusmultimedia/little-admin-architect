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

    {{--@vite([/*'resources/css/app.css',*/ 'resources/js/app.js'])--}}
</head>
<body class="bg-gray-100">
<header class="bg-white sticky top-0 z-10 lg:ml-[20rem] border-b ">
    <nav class="bg-white border-gray-200 dark:bg-gray-900 ml-0">
        <div class="container flex flex-wrap items-center justify-between mx-auto py-4">
            <div class="flex items-center">
                {{--<x-little-anonyme::form-components.fields.icons.logo class="h-8"/>--}}
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white uppercase">{{ $title }}</span>
            </div>
            <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden w-full md:inline-flex md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col items-center justify-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li x-data="{}" class="relative">
                        <input type="text" id="little-admin.globalResearchField" class="w-64 py-2 text-sm pr-7" placeholder="Global search">
                        <div class="absolute right-0 top-0 bottom-0 flex items-center pr-2">
                            <x-heroicon-o-magnifying-glass class="w-5"/>
                        </div>

                    </li>
                    <li class="">
                        <a href="#"
                           class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                            <x-heroicon-o-bell-alert class="w-6 text-primary-400"/>
                        </a>
                    </li>
                    <li class="" x-data="{}">
                        <div x-cloak
                             class="relative block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0  md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent cursor-pointer"
                             x-data="DropdownMenu"
                             x-on:click="show = true"
                        >
                            <x-heroicon-m-user-circle class="w-10 text-slate-400"/>
                            <div x-bind="showMenu"
                                 class="absolute right-0 top-[100%_+_4px] rounded-lg bg-white z-20 shadow-md border border-primary-200 flex flex-col
                                   min-w-[12rem] whitespace-nowrap  divide-y text-sm overflow-hidden"
                            >
                                <div class="px-4 py-2 hover:text-primary-600 hover:bg-primary-50"> {{ auth()->user()?->name }}</div>

                                <form action="{{ route(config('little-admin-architect.route.prefix') .'.auth.logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center space-x-2 px-4 py-2 hover:text-primary-600 hover:bg-primary-50/40 w-full text-left">
                                        <x-heroicon-o-magnifying-glass class="w-5"/>
                                        <span>Log Out</span>
                                    </button>
                                </form>


                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<aside class="w-[20rem]  border-r border-gray-100 bg-white fixed top-0 -left-[20rem] bottom-0 lg:left-0 shadow-lg overflow-x-hidden overflow-y-auto pb-5  z-10">
    <a href="#" class="flex items-center bg-white py-5  border-b sticky top-0">
        <x-little-anonyme::form-components.fields.icons.logo class="text-primary-500 h-8"/>
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Little Admin</span>
    </a>
    <div class="flex flex-col">
        <div class="flex flex-col">
            @foreach(LittleAdminArchitect::getNavigationPages() as $group => $navigations)
                <div class="flex flex-col gap-1 mb-5">

                    @foreach($navigations as $navigation)
                        @if($loop->first)
                            <div
                                @class([
                                    'text-slate-500 bg-gray-50 px-3 py-2 text-lg font-medium',
                                    'bg-primary-100' => request()->routeIs($navigation['route_prefix'])
                                 ])
                            >
                                {{ $group }}
                            </div>
                        @endif
                        <div class="flex">
                            <a href="{{ route($navigation['route_name']) }}"
                                @class([
                                    'hover:bg-gray-50 pl-10 py-1 rounded-md grow duration-200',
                                    'text-primary-600' => request()->routeIs($navigation['route_resource'])
                                 ])

                            >
                                {{ $navigation['title'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
</aside>
<div class="ml-0 lg:ml-[20rem] ">
    <div class="container mx-auto ">
        {{ $slot }}
    </div>
</div>

@livewire('little-admin-architect.modal')
@livewire('little-admin-notification')
@livewireScripts
<script defer src="{{ route('little-admin.page.assets.js','app.js') }}"></script>
</body>
</html>
