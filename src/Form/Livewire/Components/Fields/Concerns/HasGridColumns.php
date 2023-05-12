<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasGridColumns
{
    protected string $columns = 'lg:grid-cols-1';

    public function columns(int $columns): static
    {
        $this->columns = 'lg:grid-cols-' . $columns;

        return $this;
    }

    public function getColumns(): string
    {
        return $this->columns;
    }
}
