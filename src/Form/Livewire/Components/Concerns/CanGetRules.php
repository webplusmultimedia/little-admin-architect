<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait CanGetRules
{

    public function getRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules = $field->interactWithRules(rules: $rules,model: $this->getBind());
        }

        return $rules;
    }

    public function getAttributesRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules = $field->applyAttributesRules($rules);
        }

        return $rules;
    }

}
