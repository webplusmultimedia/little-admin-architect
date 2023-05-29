<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasSortableColum
{
    protected ?string $sortableColumn = null;

    protected ?string $sortDirection = null;

    protected string $defaultDirection = 'asc';

    public function sortableColumn(string $column): static
    {
        $this->sortableColumn = $this->hasColumn($column);

        return $this;
    }

    public function asc(): static
    {
        $this->sortDirection = 'asc';

        return $this;
    }

    public function desc(): static
    {
        $this->sortDirection = 'desc';

        return $this;
    }

    public function applyParamsForSortingColumn(?string $column, ?string $direction = null): void
    {
        $this->sortableColumn = $this->hasColumn($column);
        $this->sortDirection = $this->hasDirection($direction);
    }

    public function getSortColumn(): ?string
    {
        return $this->sortableColumn;
    }

    public function getSortDirection(): ?string
    {
        return $this->sortDirection;
    }

    protected function hasColumn(?string $column): ?string
    {
        if ($column and collect($this->columns)->filter(fn (AbstractColumn $col) => $col->getName() === $column and $col->isSortable())->count()) {
            return $column;
        }

        return $this->sortableColumn;
    }

    protected function hasDirection(?string $dir): string
    {
        if ($dir and in_array($dir, ['asc', 'desc'])) {
            return $dir;
        }

        return $this->sortDirection ?? $this->defaultDirection;
    }
}
