<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;

class Table extends BaseTable implements Htmlable
{
    public function render(): View
    {
        $this->table->applyParamsForSortingColumn(column: $this->tableSortColumn, direction: $this->tableDirection);

        $this->table->applyQueryToRecords($this->search);

        return view('little-views::livewire.table', ['title' => $this->table->getTableTitle(), 'table' => $this->table]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
