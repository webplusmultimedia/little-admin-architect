<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasSelectField;

class SelectFilter extends BaseFilter
{
    use HasSelectField;

    protected function setUp(): array
    {
        $field = Select::make($this->getFilterPath())
            ->reactive(false)
            ->label($this->label ?? $this->name);
        $field->setPrefixPath($this->prefixPath);
        $this->configure($field);
        $default = $this->isMultiple ? [] : null;

        if ( ! data_get($this->livewire, $field->getStatePath())) {
            data_set($this->livewire, $field->getStatePath(), $default);
            $field->applyDefaultValue();
        }

        return [$field];
    }

    protected function getFilterPath(Field $field = null): string
    {
        return $this->name . '.values';
    }
}
