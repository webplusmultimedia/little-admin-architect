@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Container; @endphp
@php
    /** @var Container $container */
@endphp

<div {{ $attributes->class("la__form__container__wrapper")->merge(['class'=>$container->getColSpan()]) }}
     x-data="{}"
     wire:key="{{ $container->getWireKey()  }}"
>
    @if($container->title )
        <div class="bg-gray-50 rounded-t-md py-3 dark:bg-gray-900">
            <h2 class="text-lg m-0 uppercase pl-5">{{ $container->title }}</h2>
        </div>
    @endif
        <div {{ $attributes->class(" py-3 grid grid-cols-1 gap-5 px-5")->merge(['class'=>$container->getColumns()]) }}>
            @foreach($container->getFields() as $field)
                @if($field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field and !$field->isHiddenOnForm() )
                    {{ $field }}
                @endif
            @endforeach
        </div>
</div>
