<?php
declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class Table extends Component implements Htmlable
{
    use WithPagination;

    public bool $initialized = true;
    public ?string $routeName = NULL;
    protected null|string $pageRoute = NULL;
    protected null|\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $_table = NULL;

    public function mount(string $pageRoute)
    {
        $this->pageRoute = $pageRoute;
    }


    protected function setUp()
    {
        $this->pageRoute = $this->pageRoute ?? request()->collect('fingerprint')->get('name');

        $pageClass = str($this->pageRoute)
            ->explode('.')
            ->map(fn(string $segment) => str($segment)->studly())
            ->implode('\\');
        /** @var Page $page */
        $page = app($pageClass);

        /** @var Resources $resource */
        $resource = $page::getResource();
        $records = $resource::getEloquentQuery()->paginate($page::getRowsPerPage());
        $this->_table = $resource::getTable(\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table::make($resource::getPluralModelLabel()));
        $this->_table->records($records);

        return [
            'title' => $resource::getPluralModelLabel(),
            'table'   => $this->_table,
        ];
    }

    public function render(): View
    {
        return view('little-views::livewire.table', $this->setUp());
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
