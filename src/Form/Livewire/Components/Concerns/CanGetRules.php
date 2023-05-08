<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

trait CanGetRules
{
    public function getRules(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules = $field->interactWithRules(rules: $rules, model: $this->getBind());
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
