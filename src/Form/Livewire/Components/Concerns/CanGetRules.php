<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait CanGetRules
{
    protected array $formRules = [];
    protected array $attributesRules = [];
    public function getFormRules(): array
    {
        if (count($this->formRules)>0){
            return $this->formRules;
        }
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->interactWithRules(rules: $rules);
        }
        $this->formRules = $rules;
        return $rules;
    }

    public function hasRules(): bool
    {
        return count($this->getFormRules()) > 0;
    }

    public function getAttributesRules(): array
    {
        if (count($this->attributesRules)>0){
            return $this->attributesRules;
        }
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->applyAttributesRules($rules);
        }
        $this->attributesRules = $rules;
        return $rules;
    }
}
