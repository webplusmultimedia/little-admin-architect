@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Container;
@endphp
@props([
/** @var Container $container */
    'container'
])
<div {{ $attributes->class(" py-3 grid grid-cols-1 gap-5 px-5")->merge(['class'=>$container->getColumns()]) }}>
    @foreach($container->getFields() as $field)
        @if($field instanceof Field and !$field->isHiddenOnForm() )
            @if($field instanceof Input)
                {{ $field }}
            @else
                <x-dynamic-component :component="$field->getFieldView()" :field="$field"/>
            @endif

        @endif
    @endforeach
</div>
