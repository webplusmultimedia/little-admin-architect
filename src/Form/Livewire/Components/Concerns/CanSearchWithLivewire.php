<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Closure;
use Illuminate\Support\Collection;

trait CanSearchWithLivewire
{
    protected int $searchDebounce = 800;
    protected bool $searchable = false;

    protected bool $isMultiple = false;

    protected ?Closure $selectOptionLabelUsing = NULL;

    protected ?Closure $optionsUsing = NULL;
    protected null|Collection $optionsUsingResults = NULL;

    protected ?Closure $searchResultsUsing = NULL;

    public function getSelectOptionLabelUsing(Closure $optionLabel): static
    {
        $this->selectOptionLabelUsing = $optionLabel;

        return $this;
    }

    public function selectOptionLabelUsing(): ?Closure
    {
        return $this->selectOptionLabelUsing;
    }

    public function getOptionsUsing(Closure $optionsUsing): static
    {
        $this->optionsUsing = $optionsUsing;
        /** @var Collection $options */
        if (! $this->optionsUsingResults) {
            $this->optionsUsingResults = call_user_func($this->optionsUsing);
        }
        $options = $this->optionsUsingResults;
        $this->addRules('in:' . implode(',', $options->keys()->toArray()));

        return $this;
    }

    public function hasOptionUsing(): bool
    {
        return $this->optionsUsing !== NULL;
    }

    public function optionUsingAll(): array
    {
        if ($this->optionsUsing) {
            if (! $this->optionsUsingResults) {
                $this->optionsUsingResults = call_user_func($this->optionsUsing);
            }
            $results = $this->optionsUsingResults->toArray();
            $options = [];
            foreach ($results as $key => $result) {
                $options[] = ['label' => $result, 'value' => $key];
            }

            return $options;
        }

        return [];
    }

    public function optionsUsing(): ?Closure
    {
        return $this->optionsUsing;
    }

    public function getSearchResultsUsing(?Closure $searchResultsUsing): static
    {
        $this->searchResultsUsing = $searchResultsUsing;

        return $this;
    }

    public function searchResultsUsing(): ?Closure
    {
        return $this->searchResultsUsing;
    }

    public function isMultiple(): bool
    {
        return $this->isMultiple;
    }

    public function searchable(bool $isSearchable = true): static
    {
        $this->searchable = $isSearchable;

        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * @return int
     */
    public function getSearchDebounce(): int
    {
        return $this->searchDebounce;
    }

    /**
     * @param bool $isMultiple
     *
     * @return CanSearchWithLivewire
     */
    public function multiple(bool $isMultiple = true): static
    {
        $this->isMultiple = $isMultiple;

        return $this;
}
}
