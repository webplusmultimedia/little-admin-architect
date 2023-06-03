@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Grid; @endphp
@php
    /** @var Grid $grid */
    $grid = $getConfig()
@endphp
<div {{ $attributes->class("grid gap-5 grid-cols-12 col-span-full")->merge(['class'=>$grid->getColSpan()]) }}
     x-data="{}"
     wire:key="{{ $grid->getWireKey()  }}"
>
@foreach($grid->getGridColumns() as $column)
        <div {{ $attributes->class(" py-3 grid grid-cols-1 gap-4 content-start")->merge(['class'=>$column->getColumns()]) }}>
            @foreach($column->getFields() as $field)
                <x-dynamic-component :component="$field->getFieldView()" :field="$field"/>
            @endforeach
        </div>
@endforeach
</div>

