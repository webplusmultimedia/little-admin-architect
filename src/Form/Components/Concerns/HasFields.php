<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasFields
{
    /** @var Field[] */
    public static array $formFields = [];

    public static function addFormField(Field $field): void
    {
        static::$formFields[] = $field;
    }

    /** @return Field[] */
    public function getFormFields(): array
    {
        return static::$formFields;
    }

    public function getFormFieldByName(string $name): ?Field
    {
        foreach (static::$formFields as $field) {
            if ($field->getName() === $name) {
                return $field;
            }
            if (method_exists($field, 'getFormFieldByName')) {
                if ($childField = $field->getFormFieldByName($name)) {
                    return $childField;
                }
            }
        }

        return null;
        // return collect(static::$formFields)->filter(fn (Field $field) => $field->getName() === $name)->first();
    }

    public function getFormFieldByPath(string $path): ?Field
    {
        foreach (static::$formFields as $field) {
            if ($field->getStatePath() === $path) {
                return $field;
            }
            if (method_exists($field, 'getFormFieldByPath')) {
                if ($childField = $field->getFormFieldByPath($path)) {
                    return $childField;
                }
            }
        }

        return null;
    }

    public function setUpFieldsOnForm(bool $shouldUsePath = true): void
    {
        foreach (static::$formFields as $key => $field) {
            $field->livewire($this->livewire);
            $field->setUp();
            if ( ! $shouldUsePath) {
                $field->setPrefixPath(null);
            }
            // $field->setForm($this);    @phpstan-ignore-line
            if ($field->isHiddenOnForm()) {
                unset(static::$formFields[$key]);
            }
        }
    }

    protected function hasFormFields(): bool
    {
        return count(static::$formFields) > 0;
    }
}
