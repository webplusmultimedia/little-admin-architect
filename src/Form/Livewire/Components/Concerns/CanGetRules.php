<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Support\Arr;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait CanGetRules
{

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            if($field instanceof Field) {
                $rules['data.' . $field->name] = $field->rules;
            }
            if($field instanceof AbstractLayout){
                $rules = array_merge($rules,$field->getRules());
            }
        }

        return $rules;
    }

    public function getAttributesRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules['data.'.$field->name] = str($field->getLabel())->lower();
        }

        return $rules;
    }

}
