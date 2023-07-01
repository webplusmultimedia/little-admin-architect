@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Container;
@endphp
@props([
/** @var Container $container */
    'container'
])
<div {{ $attributes->class(" py-3 grid grid-cols-1 gap-5 px-5")->merge(['class'=>$container->getColumns()]) }}>
    @foreach($container->getFields() as $field)
        @if($field instanceof Field and !$field->isHiddenOnForm() )
            @if(
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input or
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBoxList or
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox or
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FileUpload or
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio or
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select or
                $field instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker
            )
                {{ $field }}
            @else
                <x-dynamic-component :component="$field->getFieldView()" :field="$field"/>
            @endif
        @endif
    @endforeach
</div>
