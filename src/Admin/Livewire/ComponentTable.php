<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns\CanInitTable;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns\CanSortColumn;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\InteractsWithTable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Contracts\HasTable;

/**
 * @property \Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $table
 */
class ComponentTable extends Component implements HasTable
{
    use CanSortColumn;
    use CanInitTable;
    use InteractsWithTable;

    use WithPagination;

    public bool $initialized = true;

    public ?string $routeName = NULL;

    public ?int $rowsPerPage = NULL;

    public string $search = '';

    /**
     * @var array[]
     */
    protected $queryString = [
        'search'          => ['except' => '', 'as' => 'q'],
        'tableSortColumn' => ['except' => NULL],
        'tableDirection'  => ['except' => NULL],
    ];

    protected bool $initBoot = true;

    protected null|string $pageRoute = NULL;

    protected null|\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $_table = NULL;

    protected array $formDatas;

    public function mount(string $pageRoute): void
    {

        $this->pageRoute = $pageRoute;
        $this->initBoot = false;
    }

    public function paginationView(): string
    {
        return 'little-views::table-components.pagination.pagination';
    }


}
