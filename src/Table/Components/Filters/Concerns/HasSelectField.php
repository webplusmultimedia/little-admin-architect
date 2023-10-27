<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Closure;
use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;

trait HasSelectField
{
    protected bool $searchable = false;

    protected bool $isMultiple = false;

    protected Collection | array $options = [];

    protected ?Closure $selectOptionLabelUsing = null;

    protected ?Closure $optionsUsing = null;

    protected ?Collection $optionsUsingResults = null;

    protected ?Closure $searchResultsUsing = null;

    protected bool $preload = false;

    public function getOptionUsing(Closure $optionUsing): static
    {
        $this->optionsUsing = $optionUsing;

        return $this;
    }

    protected function configure(Select $field): void
    {
        $this->setOptions($field);
        $this->setOptionUsing($field);
        $this->setMultiple($field);
        $this->setSelectOptionLabelUsing($field);
        $this->setSearchResultsUsing($field);
    }

    public function options(array | Collection $options): static
    {
        $this->options = $options;

        return $this;
    }

    protected function setOptions(Select $select): void
    {
        if ($this->options) {
            $select->options($this->options);
        }
    }

    protected function setOptionUsing(Select $select): void
    {
        if ($this->optionsUsing) {
            $select->getOptionsUsing($this->optionsUsing);
        }
    }

    public function getSelectOptionLabelUsing(Closure $selectOptionLabelUsing): static
    {
        $this->selectOptionLabelUsing = $selectOptionLabelUsing;

        return $this;
    }

    protected function setSelectOptionLabelUsing(Select $select): void
    {
        if ($this->selectOptionLabelUsing) {
            $select->getSelectOptionLabelUsing($this->selectOptionLabelUsing);
        }
    }

    public function getSearchResultsUsing(Closure $searchResultsUsing): static
    {
        $this->searchResultsUsing = $searchResultsUsing;

        return $this;
    }

    protected function setSearchResultsUsing(Select $select): void
    {
        if ($this->searchResultsUsing) {
            $select->getSearchResultsUsing($this->searchResultsUsing)->searchable();
        }
    }

    public function multiple(bool $isMultiple = true): static
    {
        $this->isMultiple = $isMultiple;

        return $this;
    }

    protected function setMultiple(Select $select): void
    {
        if ($this->isMultiple) {
            $select->multiple();
        }
    }

    public function searchable(bool $seachable = true): static
    {
        $this->searchable = $seachable;

        return $this;
    }
}
