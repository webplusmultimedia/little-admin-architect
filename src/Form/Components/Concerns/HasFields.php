<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;

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
        return collect(static::$formFields)->filter(fn (Field $field) => $field->getName() === $name)->first();
    }

    public function getFormFieldByPath(string $path): ?Field
    {
        return collect(static::$formFields)->filter(fn (Field $field) => $field->getStatePath() === $path)->first();
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
            //Add date from when Need, because can't livewire it data when range
            /*if ($field instanceof DateTimePicker and $field->getDateFromWireName()) {
                $from = Input::make($field->getDateFromName())->hidden();
                $from->record($this->model);
                $field->livewire($this->livewire);
                $from->statusForm($this->statusForm);
                static::$formFields[] = $from;
            }*/
        }
    }

    protected function hasFormFields(): bool
    {
        return count(static::$formFields) > 0;
    }
}
