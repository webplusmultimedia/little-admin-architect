<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

Trait HasColumns
{
    protected int $columns = 1;

    public function columns(int $columns)
    {
        $this->columns = $columns;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }
}
