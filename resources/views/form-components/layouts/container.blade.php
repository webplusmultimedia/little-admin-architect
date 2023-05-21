@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts\Container; @endphp
@php
    /** @var Container $config */
    $config = $getConfig()
    @endphp

<div {{ $attributes->class("pb-3 grid gap-1 border border-gray-300 rounded-md bg-white ")->merge(['class'=>$config->getColSpan()]) }}
     x-data="{}"
     wire:key="{{ $config->getWireKey()  }}"
>
    @if($config->title )
        <div class="bg-gray-100">
            <h2 class="text-2xl my-3 pl-5 text-gray-600">{{ $config->title }}</h2>
        </div>
    @endif


    <div {{ $attributes->class(" py-3 grid grid-cols-1 gap-3 px-5")->merge(['class'=>$config->getColumns()]) }}>
        @foreach($config->getFields() as $field)
            <x-dynamic-component :component="$field->getFieldView()"    :field="$field" />
        @endforeach
    </div>


</div>
