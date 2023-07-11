<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Closure;
use Illuminate\Support\Collection;

trait CanSearchWithLivewire
{
    protected int $searchDebounce = 800;

    protected bool $searchable = false;

    protected bool $isMultiple = false;

    protected int $loadLimit = 25;

    protected ?Closure $selectOptionLabelUsing = null;

    protected ?Closure $optionsUsing = null;

    protected ?Collection $optionsUsingResults = null;

    protected ?Closure $searchResultsUsing = null;

    protected bool $preload = false;

    public function getSelectOptionLabelUsing(Closure $optionLabel): static
    {
        $this->selectOptionLabelUsing = $optionLabel;

        return $this;
    }

    public function selectOptionLabelUsing(): ?Closure
    {
        return $this->selectOptionLabelUsing;
    }

    protected function getOptionsLabelUsingAll(): array
    {
        if ($this->selectOptionLabelUsing and $this->getState()) {
            if ($this->hasRelationship()) {
                /** @var Collection $results */
                $results = app()->call($this->selectOptionLabelUsing(), ['component' => $this, 'state' => $this->getState()]);
            } else {
                /** @var Collection $results */
                $results = call_user_func($this->selectOptionLabelUsing(), $this->getState());
            }

            return $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();
        }

        return [];
    }

    public function getAllLabelsForValues(): array
    {
        if ($this->isMultiple) {
            return $this->getOptionsLabelUsingAll();
        }

        return $this->optionUsingAll();
    }

    public function getOptionsUsing(Closure $optionsUsing): static
    {
        $this->optionsUsing = $optionsUsing;
        if ( ! $this->optionsUsingResults) {
            if ($this->hasRelationship()) {
                $this->optionsUsingResults = app()->call($this->optionsUsing, ['component' => $this]);
            } else {
                $this->optionsUsingResults = call_user_func($this->optionsUsing);
            }
        }

        $this->addRules('in:' . implode(',', $this->optionsUsingResults->keys()->toArray()));

        return $this;
    }

    public function hasOptionUsing(): bool
    {
        return null !== $this->optionsUsing;
    }

    protected function optionUsingAll(): array
    {
        if ($this->optionsUsing) {
            if ( ! $this->optionsUsingResults) {
                if ($this->hasRelationship()) {
                    $this->optionsUsingResults = app()->call($this->optionsUsing, ['component' => $this]);
                } else {
                    $this->optionsUsingResults = call_user_func($this->optionsUsing);
                }
            }
            $results = $this->optionsUsingResults;

            return $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();
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

    public function getSearchDebounce(): int
    {
        return $this->searchDebounce;
    }

    public function multiple(bool $isMultiple = true): static
    {
        $this->isMultiple = $isMultiple;
        $this->addRules('array');

        return $this;
    }

    public function preload(bool $preload = true): static
    {
        $this->preload = $preload;

        return $this;
    }

    public function loadingLimit(int $loadLimit): static
    {
        $this->loadLimit = $loadLimit;

        return $this;
    }
}
