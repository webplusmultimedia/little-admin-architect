<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Closure;

trait CanSearchWithLivewire
{
    protected string $search;
    protected bool $isMultiple = false;
    protected ?Closure $selectOptionLabelUsing = NULL;
    protected ?Closure $optionsUsing = NULL;
    protected ?Closure $searchResultsUsing = NULL;

    public function selectOptionLabelUsing(Closure $optionLabel): static
    {
        $this->selectOptionLabelUsing = $optionLabel;

        return $this;
    }

    public function getSelectOptionLabelUsing(): ?Closure
    {
        return $this->selectOptionLabelUsing;
    }

    public function getOptionsUsing(?Closure $optionsUsing): static
    {
        $this->optionsUsing = $optionsUsing;

        return $this;
    }

    public function optionsUsing(): ?Closure
    {
        return $this->optionsUsing;
    }

    public function setSearchResultsUsing(?Closure $searchResultsUsing): static
    {
        $this->searchResultsUsing = $searchResultsUsing;

        return $this;
    }

    protected function getSearchResultsUsing(): ?Closure
    {
        return $this->searchResultsUsing;
    }

    public function isMultiple(): bool
    {
        return $this->isMultiple;
    }
}
