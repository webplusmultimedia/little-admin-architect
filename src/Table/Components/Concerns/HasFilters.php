<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
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
            $filter->componentLivewire($this->livewire);
            /** @var Field $field */
            foreach ($filter->getFormFields() as $field) {
                /* if ( ! data_get($this->livewire, $field->getStatePath())) {
                     data_set($this->livewire, $field->getStatePath(), null);
                 }*/
                $field->livewire($this->livewire);
            }
        }
    }

    public function getCountActifFilters(): int
    {
        $count = 0;
        if ( ! $this->hasFilters()) {
            return 0;
        }
        foreach ($this->filters as $filter) {
            foreach ($filter->getFormFields() as $field) {
                if ( ! blank($field->getState()) and false !== $field->getState()) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function setDefaultToFilters(): void
    {
        foreach ($this->filters as $filter) {
            $filter->componentLivewire($this->livewire);
            /** @var Field $field */
            foreach ($filter->getFormFields() as $field) {
                $field->applyDefaultValue();
                /*if ($field instanceof Select) {
                    $field->setDynamicOption();
                    $field->setState([]);
                }*/
            }
        }
    }

    public function removeFilters(): void
    {
        foreach ($this->filters as $filter) {
            /** @var Field $field */
            foreach ($filter->getFormFields() as $field) {
                $field->setState(null);
                $field->emitClearEvent($field->getState());
            }
        }
    }

    public function getFilterFieldByName(string $name): ?Field
    {
        foreach ($this->filters as $filter) {
            /** @var Field $field */
            foreach ($filter->getFormFields() as $field) {
                if ($name === $field->getStatePath()) {
                    return $field;
                }
            }
        }

        return null;
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
