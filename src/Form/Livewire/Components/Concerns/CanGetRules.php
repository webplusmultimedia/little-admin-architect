<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait CanGetRules
{
    public function getRules(): array
    {
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->interactWithRules(rules: $rules);
        }

        return $rules;
    }

    public function hasRules(): bool
    {
        return count($this->getRules()) > 0;
    }

    public function getAttributesRules(): array
    {
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->applyAttributesRules($rules);
        }

        return $rules;
    }
}
