@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Grid; @endphp
@php
    /** @var Grid $grid */
    $grid = $getConfig()
@endphp
<div {{ $attributes->class("la__form__grid__wrapper")->merge(['class'=>$grid->getColSpan()]) }}
     x-data="{}"
     wire:key="{{ $grid->getWireKey()  }}"
>
@foreach($grid->getGridColumns() as $column)
        <div {{ $attributes->class("la__form__grid__content")->merge(['class'=>$column->getColumns()]) }}>
            @foreach($column->getFields() as $field)
                <x-dynamic-component :component="$field->getFieldView()" :field="$field"/>
            @endforeach
        </div>
@endforeach
</div>

