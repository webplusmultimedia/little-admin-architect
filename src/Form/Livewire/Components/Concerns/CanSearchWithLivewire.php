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

    public function getSelectOptionLabelUsing(Closure $optionLabel): static
    {
        $this->selectOptionLabelUsing = $optionLabel;

        return $this;
    }

    public function selectOptionLabelUsing(): ?Closure
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
}
