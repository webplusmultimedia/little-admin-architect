<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

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

    protected function hasFormFields(): bool
    {
        return count(static::$formFields) > 0;
    }
}
