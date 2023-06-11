<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasFields
{
    /** @var Field[] */
    protected static array $formFields = [];

    public static function addFormField(Field $field): void
    {
        static::$formFields[] = $field;
    }

    /** @return Field[] */
    public function getFormFields(): array
    {
        return static::$formFields;
    }

    protected function getFormFieldByName(string $name): ?Field
    {
        return collect(self::$formFields)->filter(fn (Field $field) => $field->getName() === $name)->first();
    }

    public function removeHiddenFieldsOnForm(): void
    {
        foreach (self::$formFields as $key => $field) {
            if ($field->isHiddenOnForm()) {
                unset(self::$formFields[$key]);
            }
        }
    }

    protected function hasFormFields(): bool
    {
        return count(static::$formFields) > 0;
    }
}
