@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts\Container; @endphp
@php
    /** @var Container $config */
    $config = $getConfig()
    @endphp
<div class="bg-cyan-50 py-3 col-span-full" {{ $attributes->class("grid gap-4")->merge(['class'=>$config->getColumns()]) }}>
    <h1 class="text-2xl mb-5">{{ $config->title }}</h1>
    @foreach($config->getFields() as $field)
        <x-dynamic-component :component="$field->getFieldView()" :name="$field->name"  :label="$field->getLabel()"  :field="$field" />
    @endforeach

</div>
