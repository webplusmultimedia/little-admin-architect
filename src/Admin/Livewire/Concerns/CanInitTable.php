<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;

trait CanInitTable
{
    protected function setUp(): Table
    {
        $this->pageRoute = $this->pageRoute ?? request()->collect('fingerprint')->get('name');

        $pageClass = str($this->pageRoute)
            ->explode('.')
            ->map(fn (string $segment) => str($segment)->studly())
            ->implode('\\');
        /** @var Page $page */
        $page = app($pageClass);

        /** @var Resources $resource */
        $resource = $page::getResource();

        $this->_table = $resource::getTableColumns(\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table::make($resource::getPluralModelLabel()));
        $this->_table
            ->configureColumns(livewireId: $this->id, page: $page,title:$resource::getPluralModelLabel());


        return   $this->_table;
    }

    protected function getTable(): Table
    {
        if (!$this->_table){
            $this->_table = $this->setUp();
        }
        return $this->_table;
    }
}
