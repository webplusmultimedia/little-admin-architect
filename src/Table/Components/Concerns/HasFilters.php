<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\BaseFilter;

trait HasFilters
{
    /**
     * @var BaseFilter[]
     */
    protected array $filters = [];

    public function getFilters(): array
    {
        return $this->filters;
    }

    protected function setLivewireToFilters(): void
    {
        foreach ($this->filters as $filter) {
            /** @var Field $field */
            foreach ($filter->getFormFields() as $field) {
                $field->livewire($this->livewire);
            }
        }
    }

    public function removeFilters(): void
    {
        foreach ($this->filters as $filter) {
            /** @var Field $field */
            foreach ($filter->getFormFields() as $field) {
                $field->setState(null);
            }
        }
    }

    public function handleQuery(Builder $builder): Builder
    {
        foreach ($this->filters as $filter) {
            $builder = $filter->handleQuery($builder);
        }

        return $builder;
    }

    public function filters(array $filters): static
    {
        $this->filters = $filters;

        return $this;
    }

    public function hasFilters(): bool
    {
        return count($this->filters) > 0;
    }
}
