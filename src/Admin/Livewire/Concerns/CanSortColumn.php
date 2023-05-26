<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

trait CanSortColumn
{
    public ?string $tableSortColumn = null;
    public ?string $tableDirection = null;
    public function sortable(string $column)
    {

    }
}
