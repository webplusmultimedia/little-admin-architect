<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

class Filter extends BaseFilter
{
    protected function setUp(): array
    {
        if (is_string($this->formFields) and is_a($this->formFields, Field::class, true)) {

            $field = $this->formFields::make($this->getFilterPath())
                ->reactive(false)
                ->label($this->label);
            $field->setPrefixPath($this->prefixPath);

            if ( ! $this->query) {
                $this->query(fn (Builder $builder, array $datas) => $builder->when($datas[$this->name], fn (Builder $q) => $q->whereNotNull($this->name)));
            }
            if ( ! data_get($this->livewire, $field->getStatePath())) {
                data_set($this->livewire, $field->getStatePath(), false);
            }

            return [$field];
        }

        return [];
    }
}
