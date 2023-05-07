<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasColumns
{
    protected string $columns = 'grid-cols-1';

    public function columns(int $columns): static
    {
        $this->columns = 'grid-cols-'.$columns;

        return $this;
    }

    public function getColumns(): string
    {
        return $this->columns;
    }
}
