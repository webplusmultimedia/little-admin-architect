<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait InteractWithAttributeRules
{
    public function applyAttributesRules(array $rules): array
    {
        $rules['data.'.$this->name] = str($this->getLabel())->lower();

        return $rules;
    }
}
