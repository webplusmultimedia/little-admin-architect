<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasQueryBuilder
{
    protected Builder $builder;

    public function builder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function applyQueryToRecords(string $search = null): void
    {
        if ($this->hasFilters()) {
            $this->builder = $this->handleQuery($this->builder);
        }
        $this->records = $this->builder
            ->when($search, fn (Builder $builder) => $this->searchQuery($builder, $search))
            ->when($this->sortableColumn, fn (Builder $builder) => $builder->orderBy($this->sortableColumn, $this->sortDirection))
            ->paginate($this->getRowsPerPage());
    }
}
