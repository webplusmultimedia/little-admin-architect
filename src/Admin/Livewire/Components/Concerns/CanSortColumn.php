<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

trait CanSortColumn
{
    public ?string $tableSortColumn = null;

    public ?string $tableDirection = null;

    public function sortable(string $column): void
    {
        if ($this->tableSortColumn === $column) {
            $this->tableDirection = 'asc' === $this->tableDirection ? 'desc' : 'asc';
        } else {
            $this->tableDirection = 'asc';
        }
        $this->tableSortColumn = $column;
    }
}
