<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\CanFilterColumn;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\CanInitTable;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\CanSortColumn;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\HasMountTableAction;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\HasNotification;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\InteractsWithTable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Contracts\HasTable;
use Webplusmultimedia\LittleAdminArchitect\Table\Concerns\InteractsWithModalForm;

/**
 * @property \Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $table
 */
class BaseTable extends Component implements HasTable
{
    use CanFilterColumn;
    use CanInitTable;
    use CanSortColumn;
    use HasMountTableAction;
    use HasNotification;
    use InteractsWithModalForm;
    use InteractsWithTable;
    use WithPagination;

    public bool $initialized = true;

    public ?string $routeName = null;

    public ?int $rowsPerPage = null;

    public string $search = '';

    public array $tableFilters = [];

    /** @phpstan-ignore-next-line */
    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'tableSortColumn' => ['except' => null],
        'tableDirection' => ['except' => null],
        'tableFilters' => ['except' => null],
    ];

    protected bool $initBoot = true;

    protected ?string $pageRoute = null;

    protected ?\Webplusmultimedia\LittleAdminArchitect\Table\Components\Table $_table = null;

    protected array $formDatas;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingTableFilters(): void
    {
        //dd('reset');
        $this->resetPage();
    }

    public function removeFilters(): void
    {
        $this->table->removeFilters();
    }

    public function mount(string $pageRoute, array $mounts = null): void
    {
        $this->pageRoute = $pageRoute;
        $this->table->authorizeAccess();
        $this->initBoot = false;
    }

    public function paginationView(): string
    {
        return 'little-views::table-components.pagination.pagination';
    }

    public function callAction(string $component, string $actionName, array $arguments = [], bool $skipRender = false): mixed
    {
        if ($skipRender) {
            $this->skipRender();
        }
        if ($componentField = $this->table->getFilterFieldByName($component) and $componentField instanceof Select) {
            return $componentField->callActionResult(action: $actionName, arguments: $arguments);
        }
        throw new Exception("This Component [{$component}] doesn't exist");
    }
}
