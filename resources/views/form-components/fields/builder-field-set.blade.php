@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\BuilderFieldSet; @endphp
@php
    /** @var BuilderFieldSet $field */
@endphp

<div class="la__form__container__wrapper lg:col-span-full"
     x-data="BuilderFieldsSetComponent(@js($field->getStatePath()))"
     wire:key="{{ $field->getWireKey()  }}"
>
    @if($field->getLabel() )
        <div class="bg-gray-50 rounded-t-md py-3 dark:bg-gray-900">
            <h2 class="text-lg m-0 uppercase pl-5">{{ $field->getLabel() }}</h2>
        </div>
    @endif
    <div {{ $attributes->class(" py-3 grid grid-cols-1 gap-5 px-5")->merge(['class'=>$field->getColumns()]) }} x-ref="laBuilderFieldSet">
        @foreach($field->getFields() as $keys => $items)
            <div {{ $attributes->class("la__form__container__wrapper")->merge(['class'=>$field->getColSpan()]) }}
                 x-data="{}"
                 wire:key="{{ $field->getWireKey()  }}"
                 data-id="{{ $keys }}"
            >
                @if($keys )
                    <div class="bg-gray-50 rounded-t-md py-1 dark:bg-gray-900 flex items-center justify-between">
                        <div class="inline-flex items-center">
                            <span class="la-icon-grip">{{ $field->getActionByName('reorder') }}</span>
                            <span class="text-sm   uppercase pl-2">{{ $keys }}</span>
                        </div>
                        {{ $field->getActionByName('delete')->wireClick("callAction('{$field->getStatePath()}','deleteFieldToFieldSet',['{$keys}'])") }}
                    </div>
                @endif
                <div {{ $attributes->class(" py-3 grid grid-cols-1 gap-5 px-5")->merge(['class'=>$field->getColumns()]) }}>
                    @foreach($items as  $item)
                        @if($item instanceof \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field and !$item->isHiddenOnForm() )
                            {{ $item }}
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex items-center justify-center">
        {{ $field->getActionByName('add') }}
    </div>
</div>
