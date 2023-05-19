<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait HasSearchableColums
{
    /** @var AbstractColumn[] array  */
    protected array $searchableColumns = [];
    public function applySearchableColumns(): static
    {
        foreach ($this->columns as $column) {
            if ($column->isSearchable()){
                $this->searchableColumns[] = $column;
            }
        }
        return $this;
    }
    protected function hasSearchableColums(): bool
    {
        return count($this->searchableColumns) > 0;
    }
    public function searchQuery(Builder $builder,string $searchValue): void
    {
        if ($this->hasSearchableColums()) {
            $builder->where(function (Builder $builder) use ($searchValue) {
                foreach ($this->searchableColumns as $searchColumn) {
                    $builder->orWhere($searchColumn->getName(),'like',"%{$searchValue}%");
                }
            });
        }
    }
}
