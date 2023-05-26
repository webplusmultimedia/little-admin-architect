<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

trait CanSortColumn
{
    public ?string $tableSortColumn = null;
    public ?string $tableDirection = null;
    public function sortable(string $column): void
    {
        if($this->tableSortColumn === $column){
            $this->tableDirection = $this->tableDirection === 'asc' ? 'desc' : 'asc';
        }
        else{
            $this->tableDirection = 'asc';
        }
        $this->tableSortColumn = $column;
    }
}
