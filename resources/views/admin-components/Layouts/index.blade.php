@php use Webplusmultimedia\LittleAdminArchitect\LittleAdminArchitect; @endphp
@props([
    'title' => NULL
])
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title?? config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @livewireStyles


    <!-- Scripts -->
    <link rel="stylesheet" href="{{ route('little-admin.page.assets','app.css') }}">
</head>
<body class="bg-gray-100">
<header x-data="{}"
        class="bg-white sticky top-0 z-10  border-b duration-150 la-dark-nav"
        x-cloak
        :class="{
        'md:ml-[20rem]' : $store.laDatas.menuOpen,
        'md:ml-[6rem]' : !$store.laDatas.menuOpen
        }"
>
    <nav class="bg-white border-gray-200 la-dark-nav ml-0 relative">
        <span class=" hidden absolute left-1.5 top-0 bottom-0 md:flex items-center pr-2"
              x-on:click="$store.laDatas.toggleMenu()"
              :class="{ 'md:hidden' : !$store.laDatas.menuOpen}"
              x-transition:enter-start.opacity.0
              x-transition:enter.duration.500ms
              x-transition:enter-end.opacity.1
        >
            <x-little-anonyme::form-components.fields.icons.menu-left class="text-primary-500 w-8 cursor-pointer"/>
        </span>
        <div class="container flex flex-wrap items-center justify-between mx-auto py-4">
            <div class="flex items-center">
                {{--<x-little-anonyme::form-components.fields.icons.logo class="h-8"/>--}}
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white uppercase">{{ $title }}</span>
            </div>
            <button data-collapse-toggle="navbar-default" type="button"
                    x-data=""
                    x-on:click.stop="!window.matchMedia('(min-width : 1024px)').matches && $store.laDatas.toggleMenu()"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false"
            >
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
                             class="relative block py-2 pl-3 pr-4 text-gray-900 rounded  md:hover:bg-transparent md:border-0  md:p-0
                                  cursor-pointer"
                             x-data="DropdownMenu"
                             x-on:click="show = true"
                        >
                            <x-heroicon-m-user-circle class="w-10 text-slate-400"/>
                            <div x-bind="showMenu"
                                 class="absolute right-0 top-[calc(100%_+_4px)] rounded-lg  z-20 shadow-md border border-primary-200 flex flex-col bg-white
                                   min-w-[12rem] whitespace-nowrap   text-sm overflow-hidden
                                   dark:bg-gray-900 dark:text-white dark:border-gray-400/40"
                            >
                                <div class="px-4 py-2 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-500 dark:hover:text-white "> {{ auth()->user()->name }}</div>

                                <div class="p-1" dark-mode="dark-mode" x-data="{
            mode: null,

            theme: null,

            init: function () {
            $watch('theme', () => {
                    if (this.mode === 'auto') return

                    localStorage.setItem('theme', this.theme)

                    if (this.theme === 'dark' &amp;&amp; (! document.documentElement.classList.contains('dark'))) {
                        document.documentElement.classList.add('dark')
                    } else if (this.theme === 'light' &amp;&amp; document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark')
                    }

                    $dispatch('dark-mode-toggled', this.theme)
                })

                this.theme = localStorage.getItem('theme') || (this.isSystemDark() ? 'dark' : 'light')
                this.mode = localStorage.getItem('theme') ? 'manual' : 'auto'

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
                    if (this.mode === 'manual') return

                    if (event.matches &amp;&amp; (! document.documentElement.classList.contains('dark'))) {
                        this.theme = 'dark'

                        document.documentElement.classList.add('dark')
                    } else if ((! event.matches) &amp;&amp; document.documentElement.classList.contains('dark')) {
                        this.theme = 'light'

                        document.documentElement.classList.remove('dark')
                    }
                })


            },

            isSystemDark: function () {
                return window.matchMedia('(prefers-color-scheme: dark)').matches
            },
        }">
                                    <div>
                                        <button type="button" wire:loading.attr="disabled"
                                                class="group flex w-full items-center whitespace-nowrap rounded-md p-2 text-sm outline-none hover:text-white focus:text-white hover:bg-primary-500 focus:bg-primary-500"
                                                x-show="theme === 'dark'" x-on:click="mode = 'manual'; theme = 'light'" style="display: none;">
                                            <svg wire:loading.remove.delay="" wire:target=""
                                                 class="mr-2 h-5 w-5 group-hover:text-white group-focus:text-white text-primary-500"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                            </svg>
                                            <span class="truncate w-full text-start">
                                                Light mode
                                            </span>
                                        </button>
                                        <button type="button" wire:loading.attr="disabled"
                                                class="group flex w-full items-center whitespace-nowrap rounded-md p-2 text-sm outline-none hover:text-white focus:text-white hover:bg-primary-500 focus:bg-primary-500"
                                                x-show="theme === 'light'" x-on:click="mode = 'manual'; theme = 'dark'">
                                            <svg wire:loading.remove.delay="" wire:target=""
                                                 class=" mr-2 h-5 w-5 group-hover:text-white group-focus:text-white text-primary-500"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="truncate w-full text-start">
                                                Dark mode
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <form action="{{ route(config('little-admin-architect.route.prefix') .'.auth.logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                            class="group inline-flex items-center space-x-2 px-4 py-2 hover:text-primary-600 hover:bg-primary-50/40 w-full text-left
                                            dark:hover:bg-primary-500 dark:hover:text-white ">
                                        <x-heroicon-o-power class="w-5 text-error dark:group-hover:text-white "/>
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

<aside
    class="flex flex-col border-r border-gray-100 bg-white fixed top-0  h-screen lg:left-0 shadow-lg overflow-x-hidden overflow-y-auto pb-5  z-10 transition-all duration-150 la-dark-nav"
    :class="{
        '-x-translate-full w-[20rem]' : window.matchMedia('(min-width : 1024px)').matches && $store.laDatas.menuOpen,

        //'w-[20rem]' : !window.matchMedia('(max-width : 1024px)').matches?$store.laDatas.menuOpen:true ,
        'w-[6rem] x-translate-0' : !window.matchMedia('(min-width : 1024px)').matches && !$store.laDatas.menuOpen,
        //'flex flex-col' : window.matchMedia('(min-width : 1024px)').matches?!$store.laDatas.isMobileMenuShow:false,
        //'hidden' : !window.matchMedia('(min-width : 1024px)').matches?!$store.laDatas.isMobileMenuShow:false
    }"
    {{--x-show="window.matchMedia('(max-width : 1024px)').matches && $store.laDatas.isMobileMenuShow || $store.laDatas.menuOpen "--}}
    x-cloak
    x-data="{ }"
>
    <div class="flex  items-center justify-between bg-white py-5 gap-2  border-b sticky top-0 la-dark-nav">
        <a href="#" class="flex items-center gap-2">
            <x-little-anonyme::form-components.fields.icons.logo class="text-primary-500 h-8"/>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                  {{--:class="{ 'md:hidden' : !$store.laDatas.menuOpen}"--}}
                  x-show="window.matchMedia('(min-width : 1024px)').matches && $store.laDatas.menuOpen"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter="delay-100 duration-300"
                  x-transition:enter-end="opacity-100"

            >
                Little Admin
            </span>
        </a>
        <span class="flex items-center pr-2" x-data="{}"
              x-on:click="window.matchMedia('(min-width : 1024px)').matches && $store.laDatas.toggleMenu()"
              :class="{ 'md:hidden' : $store.laDatas.menuOpen}"
        >
            <x-little-anonyme::form-components.fields.icons.menu-left class="text-primary-500 w-8 cursor-pointer"/>
        </span>
    </div>
    <div class="flex flex-col">
        <div class="flex flex-col">
            @foreach(LittleAdminArchitect::getNavigationPages() as $group => $navigations)
                <div class="flex flex-col gap-1 mb-5">
                    <div
                        {{-- :class="{
                                     'text-primary-600 font-bold bg-transparent border-b border-primary-100' : {{ request()->routeIs($navigation['route_prefix'])?'true':'false' }},
                                     'text-slate-700 border-b border-primary-100' : {{ !request()->routeIs($navigation['route_prefix'])?'true':'false' }},

                                 }"--}}
                        class="px-3 py-2 text-lg font-medium border-b border-primary-100  dark:border-gray-400/30"
                    >
                                <span
                                    x-show="window.matchMedia('(min-width : 1024px)').matches && $store.laDatas.menuOpen"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter="delay-100 duration-300"
                                    x-transition:enter-end="opacity-100"
                                >
                                    {{ str($group)->snake()->replace('_',' ')->title() }}
                                </span>

                    </div>
                    @foreach($navigations as $navigation)

                        <div class="flex">

                            <a href="{{ route($navigation['route_name']) }}"
                               :class="{
                                    'border-primary-600 bg-primary-50/80 text-primary-600 font-bold pl-4  dark:bg-primary-400/10 dark:text-primary-400' : {{  request()->routeIs($navigation['route_resource'])?'true':'false' }} && $store.laDatas.menuOpen,
                                    'bg-primary-50/80 text-primary-600 font-bold' : {{  request()->routeIs($navigation['route_resource'])?'true':'false' }} && !$store.laDatas.menuOpen,
                                    'flex justify-center pl-0 border-none  dark:hover:text-white/90 dark:hover:bg-primary-400/10' : !$store.laDatas.menuOpen,
                                    'text-slate-500 border-transparent pl-4  dark:text-white/70 dark:hover:text-white/90 dark:hover:bg-primary-400/10' : {{ !request()->routeIs($navigation['route_resource'])?'true':'false' }} && $store.laDatas.menuOpen
                               }"
                               class="inline-flex items-center space-x-4 hover:bg-gray-50 py-2 grow border-l-4 duration-200"
                            >
                                @if($navigation['icon'])
                                    <x-dynamic-component :component="$navigation['icon']" class="w-6"/>
                                @else
                                    <x-heroicon-o-chevron-double-right class="w-7"/>
                                @endif
                                <span :class="{'md:hidden' : !$store.laDatas.menuOpen}">{{ $navigation['title'] }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
</aside>
<div class="ml-0 duration-150"
     x-cloak
     :class="{
        'md:ml-[20rem]' : $store.laDatas.menuOpen,
        'md:ml-[6rem]' : !$store.laDatas.menuOpen
        }"
     x-data="{}"
>
    <div class="container mx-auto ">
        {{ $slot }}
    </div>
</div>

@livewire('little-admin-architect.modal')
@livewire('little-admin-notification')
@livewireScripts
@stack('scripts')
<script defer src="{{ route('little-admin.page.assets','app.js') }}"></script>
</body>
</html>
