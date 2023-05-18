<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class Table extends Component implements Htmlable
{
    use WithPagination;

    public bool $initialized = true;

    public ?string $routeName = NULL;

    public ?int $rowsPerPage = NULL;

    public string $search= '';

    protected $queryString = [
        'search' => ['except' => '', 'as'=>'q'],
    ];
    protected bool $initBoot = true;
    protected null|string $pageRoute = NULL;

    protected null|\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $_table = NULL;
    protected array $formDatas;

    public function mount(string $pageRoute): void
    {
        $this->pageRoute = $pageRoute;
        //$this->formDatas = $this->setUp();
        $this->initBoot = false;
    }

   /* public function dehydrateSearch($value)
    {
        $this->search = $value;
       // dump($this->search);
        //$this->formDatas = $this->setUp();
        $this->initBoot = false;
    }
    public function booted(): void
    {
        if ($this->initBoot) {
           // dump($this->search);
            $this->formDatas = $this->setUp();
        }
    }*/

    protected function setUp()
    {
        $this->pageRoute = $this->pageRoute ?? request()->collect('fingerprint')->get('name');

        $pageClass = str($this->pageRoute)
            ->explode('.')
            ->map(fn(string $segment) => str($segment)->studly())
            ->implode('\\');
        /** @var Page $page */
        $page = app($pageClass);

        // dump($page::getEditRoute());
        /** @var Resources $resource */
        $resource = $page::getResource();
        if (! $this->rowsPerPage) {
            $this->rowsPerPage = $resource::getRowsPerPage();
        }

        $records = $resource::getEloquentQuery()
            ->when($this->search, function (Builder $builder) {
                $builder->where('titre', 'like', "%{$this->search}%");
            })
            ->paginate($this->rowsPerPage);
        $this->_table = $resource::getTableColumns(\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table::make($resource::getPluralModelLabel()));
        $this->_table->records($records);
        $this->_table->applyHeaders();
        $this->_table->setPagesForResource($page);

        return [
            'title' => $resource::getPluralModelLabel(),
            'table' => $this->_table,
        ];
    }

    public function paginationView()
    {
        return 'little-views::table-components.pagination.pagination';
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
