@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Container; @endphp
@php
    /** @var Container $container */
    $container = $getConfig()
@endphp

<div {{ $attributes->class("la__form__container__wrapper")->merge(['class'=>$container->getColSpan()]) }}
     x-data="{}"
     wire:key="{{ $container->getWireKey()  }}"
>
    @if($container->title )
        <div class="bg-gray-50 rounded-t-md py-3">
            <h2 class="text-lg m-0 uppercase pl-5">{{ $container->title }}</h2>
        </div>
    @endif
    <x-little-anonyme::form-components.layouts.fields :container="$container"/>
</div>
