<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasGridColumns
{
    protected int $columns = 1;

    public function columns(int $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    public function getColumns(): string
    {
        return match ($this->columns) {
            1 => 'lg:grid-cols-1',
            2 => 'lg:grid-cols-2',
            3 => 'lg:grid-cols-3',
            4 => 'lg:grid-cols-4',
            default => 'lg:grid-cols-4'
        };
    }
}
