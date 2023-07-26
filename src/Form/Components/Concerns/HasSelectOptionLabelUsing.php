<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;

trait HasSelectOptionLabelUsing
{
    /** @var array<string,Closure> */
    protected array $selectOptionLabelsUsing = [];

    /**
     * @return array<string,Closure>
     */
    public function getSelectOptionLabelsUsing(): array
    {
        return $this->selectOptionLabelsUsing;
    }

    public function addSelectOptionLabelsUsing(string $name, Closure $selectOptionLabelsUsing): void
    {
        $this->selectOptionLabelsUsing[$name] = $selectOptionLabelsUsing;
    }

    public function hasSelectOptionLabelsUsing(): bool
    {
        return count($this->selectOptionLabelsUsing) > 0;
    }

    protected function initSelectUsing(): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field instanceof Select) {
                //$field->setUp();
                if ($field->optionsUsing()) {
                    $this->addToListOptionsUsing($field->getStatePath(), $field->optionsUsing());
                }
                if ($field->searchResultsUsing()) {
                    $this->addToSearchResultsUsing($field->getStatePath(), $field->searchResultsUsing());
                }
                if ($field->selectOptionLabelUsing()) {
                    $this->addSelectOptionLabelsUsing($field->getStatePath(), $field->selectOptionLabelUsing());
                    if ( ! $field->isMultiple()) {
                        $field->setDefaultLabelForSelect($this);
                    }
                }
            }
        }
    }
}
