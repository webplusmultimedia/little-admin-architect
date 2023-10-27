<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Livewire\TemporaryUploadedFile;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\CustomPropertiesCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Textarea;

trait HasCustomProperties
{
    protected bool $canEditCustomProperties = false;

    protected function defaultCustomProperties(): void
    {
        $fields = [
            Input::make('alt')
                ->maxLength(255)
                ->required(),
            Input::make('title')
                ->nullable()
                ->maxLength(255),
            Textarea::make('texte')
                ->nullable(),
        ];
        $this->formAction = CustomPropertiesCreateAction::make('edit-custom-properties')
            ->schemas(fields: $fields)
            ->withoutLabel();
        $this->formAction->label('Custom properties');
        $this->hasFormAction = true;
    }

    /**
     * @param  Field[]  $schemas
     */
    public function withCustomProperties(array $schemas = []): static
    {
        $this->canEditCustomProperties = true;
        $fields = [
            Input::make('alt')
                ->maxLength(255)
                ->required(),
            Input::make('title')
                ->nullable()
                ->maxLength(255),
        ];

        foreach ($schemas as $schema) {
            //if (in_array(get_class($schema), [Input::class, DateTimePicker::class, CheckBox::class, Radio::class, Select::class, Textarea::class]) /*and ! $field->isHiddenOnForm()*/) {
            $fields[] = $schema;
            //}
        }
        $this->formAction = CustomPropertiesCreateAction::make('edit-custom-properties')
            ->schemas(fields: $fields)
            ->withoutLabel();
        $this->formAction->label('Custom properties');
        $this->hasFormAction = true;

        return $this;
    }

    public function hasCustomProperties(): bool
    {
        if ($this->hasFormAction) {
            return $this->formAction->authorize();
        }

        return false;
    }

    protected function getMissingCustomProperties(array $file): array
    {
        /** @var array $customProperties */
        $customProperties = $file['customProperties'];
        foreach ($this->formAction->getFields() as $field) {
            if ( ! isset($customProperties[$field->getName()])) {
                $customProperties[$field->getName()] = null;
            }
        }

        return $customProperties;
    }

    protected function getBlankCustomProperties(TemporaryUploadedFile | array | string $file): array
    {
        // @todo : add parameter : file (tmp or file) to retrieve alt on new file
        $customProperties = [];
        if ($this->formAction) {
            foreach ($this->formAction->getFields() as $field) {
                $value = null;
                if ('alt' === $field->getName()) {
                    $value = $this->getCustomAltProperty($file);
                }
                $customProperties[$field->getName()] = $value;
            }
        }

        return $customProperties;
    }

    protected function getCustomAltProperty(TemporaryUploadedFile | array | string $file): string
    {
        $altProperty = null;
        if ($file instanceof TemporaryUploadedFile) {
            $altProperty = $file->getClientOriginalName();
        }
        if (is_array($file)) {
            $altProperty = $file['file'];
        }
        if (is_string($file)) {
            $altProperty = $file;
        }

        return str($altProperty)
            ->beforeLast('.')
            ->headline()
            ->lower()
            ->ucfirst()
            ->value();
    }

    public function canEditCustomProperties(): bool
    {
        if ($this->canEditCustomProperties) {
            return $this->formAction->authorize();
        }

        return $this->canEditCustomProperties;
    }
}
