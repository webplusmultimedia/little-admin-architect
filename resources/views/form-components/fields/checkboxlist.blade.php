@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\CheckBoxList;
/** @var CheckBoxList $config */
    $config = $getConfig();
    $id = $config->getId();

    $errorMessage =  $getErrorMessage($errors);

@endphp
<x-dynamic-component :component="$config->getWrapperView()"
                     :id="str($config->getName())->pipe('md5')->append('-',$id)"
                     {{ $attributes->class('grid col-span-full')->merge(['class'=> $config->getColumns()]) }}

                     x-data="{ errors : $wire.__instance.errors}"
>
@foreach($config->getOptions() as $key => $option)
    @php($idGroup = str($key)->slug()->append($id))
        <x-dynamic-component :component="$config->getViewComponentForLabel()"
                             :id="$idGroup"
                             class=" items-center gap-2" :label="$option"
                             :showRequired="false"
        >

                <input {{ $attributes->merge([
                            'wire:model' . $config->getWireModifier() => ($config->getWireName()),
                            'id' => $idGroup,
                            'aria-describedby' => $idGroup
                        ])
                       }}
                       type="checkbox"
                >
        </x-dynamic-component>
@endforeach
</x-dynamic-component>
