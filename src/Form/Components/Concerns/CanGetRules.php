<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait CanGetRules
{
    protected array $formRules = [];

    protected array $attributesRules = [];

    protected function getRulesBeforeValidate(): array
    {
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->beforeSaveRulesUsing(rules: $rules);
        }
        $this->formRules = $rules;

        return $rules;
    }

    public function getFormsRules(): array
    {
        return $this->formRules;
    }

    public function getDehydrateFormRules(): array
    {
        /* if (count($this->formRules) > 0) {
             return $this->formRules;
         }*/
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->dehydrateRules(rules: $rules);
        }
        $this->formRules = $rules;

        return $rules;
    }

    public function getHydrateFormRules(): array
    {
        $rules = [];
        /** @var Field $field */
        foreach (static::$formFields as $field) {
            $rules = $field->hydrateRules(rules: $rules);
        }
        $this->formRules = $rules;

        return $rules;
    }

    public function hasRules(): bool
    {
        return count($this->getFormsRules()) > 0;
    }

    public function getAttributesRules(): array
    {
        if (count($this->attributesRules) > 0) {
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
