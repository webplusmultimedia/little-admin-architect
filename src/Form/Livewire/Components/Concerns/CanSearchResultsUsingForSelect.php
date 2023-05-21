<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Closure;

trait CanSearchResultsUsingForSelect
{
    /** @var array<string,Closure> */
    protected array $searchResultsUsing = [];

    /**
     * @return array<string,Closure>
     */
    public function getSearchResultsUsing(): array
    {
        return $this->searchResultsUsing;
    }

    protected function addToSearchResultsUsing(string $name, Closure $searchClosure): void
    {
        $this->searchResultsUsing[$name] = $searchClosure;
    }

    public function hasSearchResultsUsing(): bool
    {
        return count($this->searchResultsUsing) > 0;
    }
}
