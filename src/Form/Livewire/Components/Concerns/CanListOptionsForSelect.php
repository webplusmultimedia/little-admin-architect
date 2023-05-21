<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Closure;

trait CanListOptionsForSelect
{
    /** @var array<string,Closure> */
    protected array $listOptionsUsing = [];

    /**
     * @return array<string,Closure>
     */
    public function getListOptionsUsing(): array
    {
        return $this->listOptionsUsing;
    }

    protected function addToListOptionsUsing(string $name, Closure $optionUsing): void
    {
        $this->listOptionsUsing[$name] = $optionUsing;
    }

    public function hasOptionsUsing(): bool
    {
        return count($this->listOptionsUsing) > 0;
    }
}
