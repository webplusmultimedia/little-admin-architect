<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Livewire\TemporaryUploadedFile;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\CustomPropertiesCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Textarea;

trait HasCustomProperties
{
    protected array $blankCustomProperties = [];

    /**
     * @param  Field[]  $schemas
     */
    public function withCustomProperties(array $schemas = []): static
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
        foreach ($schemas as $schema) {
            if (in_array(get_class($schema), [Input::class, DateTimePicker::class, CheckBox::class, Radio::class, Select::class, Textarea::class]) /*and ! $field->isHiddenOnForm()*/) {
                $fields[] = $schema;
            }
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

    public function getBlankCustomProperties(TemporaryUploadedFile|array|string $file): array
    {
        // @todo : add parameter : file (tmp or file) to retrieve alt on new file
        $customProperties = [];
        if ($this->formAction) {
            foreach ($this->formAction->getFields() as $field) {
                $name = null;
                if ('alt' === $field->getName()) {
                    $name = $this->getCustomAltProperty($file);
                }
                $customProperties[$field->getName()] = $name;
            }
        }

        return $customProperties;
    }

    protected function getCustomAltProperty(TemporaryUploadedFile|array|string $file): string
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
}
