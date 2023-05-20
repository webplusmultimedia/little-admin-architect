<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasSearchableColumns
{
    protected bool $showSearchBar = false;

    /** @var AbstractColumn[] */
    protected array $searchableColumns = [];

    public function applySearchableColumns(): static
    {
        foreach ($this->columns as $column) {
            if ($column->isSearchable()) {

                $this->searchableColumns[] = $column;
            }
        }
        if (count($this->searchableColumns)) {
            $this->showSearchBar = true;
        }

        return $this;
    }

    protected function hasSearchableColumns(): bool
    {
        return count($this->searchableColumns) > 0;
    }

    public function searchQuery(Builder $builder, string $searchValue): void
    {
        if ($this->hasSearchableColumns()) {
            $builder->where(function (Builder $builder) use ($searchValue): void {
                foreach ($this->searchableColumns as $searchColumn) {
                    $builder->orWhere($searchColumn->getName(), 'like', "%{$searchValue}%");
                }
            });
        }
    }

    public function showSearchBar(): bool
    {
        return count($this->searchableColumns) > 0;
    }
}