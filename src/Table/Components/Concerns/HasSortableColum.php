<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

trait HasSortableColum
{
    protected ?string $sortableColumn = null;
    protected ?string $sortDirection = null;

    protected string $defaultDirection = 'asc';

    public function sortableColumn(string $column): static
    {
        $this->sortableColumn = $column;
        return $this;
    }
    public function asc(): static
    {
        $this->sortDirection = 'asc';
        return $this;
    }
    public function desc(): static
    {
        $this->sortDirection = 'asc';
        return $this;
    }

    public function getSortColumn(): ?string
    {
        return $this->sortableColumn;
    }

    public function getSortDirection(): string
    {
        if (!$this->sortDirection){
            return $this->defaultDirection;
        }
        return $this->sortDirection;
    }
}
