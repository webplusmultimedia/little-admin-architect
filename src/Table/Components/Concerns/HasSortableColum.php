<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasSortableColum
{
    protected ?string $sortableColumn = NULL;
    protected ?string $sortDirection = NULL;

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

    public function applyParamsForSortingColumn(?string $column, ?string $direction = NULL): void
    {
            $this->sortableColumn = $this->hasColumn($column);
            $this->sortDirection =  $this->hasDirection($direction);
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
        if($column and collect($this->columns)->filter(fn(AbstractColumn $col) => $col->getName() === $column)->count()){
            return $column;
        }
        return $this->sortableColumn ;
    }

    protected function hasDirection(?string $dir): string
    {
        if($dir and in_array($dir,['asc','desc'])){
            return $dir;
        }
        return  $this->sortDirection??$this->defaultDirection;
    }
}
