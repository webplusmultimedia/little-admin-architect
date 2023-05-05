@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts\Container; @endphp
@php
    /** @var Container $config */
    $config = $getConfig()
    @endphp

<div {{ $attributes->class("py-3 grid gap-2 col-span-full border border-gray-200 rounded-md bg-white") }}
     x-data="{}"
     wire:key="{{str($config->title)->pipe('md5')->append('-',str($config->title)->kebab())}}"
>
    <h1 class="text-2xl mb-5 pl-3">{{ $config->title }}</h1>
    <div {{ $attributes->class(" py-3 grid gap-2 ")->merge(['class'=>$config->getColumns()]) }}>
        @foreach($config->getFields() as $field)
            <x-dynamic-component :component="$field->getFieldView()" :name="$field->name"   :field="$field" />
        @endforeach
    </div>


</div>
