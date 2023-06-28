<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
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

        /** @var resource $resource */
        $resource = $page::getResource();

        $this->_table = $resource::getTableColumns(\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table::make($resource::getPluralModelLabel()));
        $this->_table
            ->configureColumns(livewire: $this, page: $page, title: $resource::getPluralModelLabel());

        return $this->_table;
    }

    protected function getTable(): Table
    {
        if ( ! $this->_table) {
            $this->_table = $this->setUp();
        }

        return $this->_table;
    }
}
