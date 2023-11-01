<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Support\Form\Concerns\CanAuthorizeAccess;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasActionModal;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasFilters;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeaderAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasQueryBuilder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRecords;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowActions;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowsPerPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSearchableColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSortableColum;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table extends Component implements Htmlable
{
    use CanAuthorizeAccess;
    use HasActionModal;
    use HasColumns;
    use HasFilters;
    use HasHeader;
    use HasHeaderAction;
    use HasQueryBuilder;
    use HasRecords;
    use HasRowActions;
    use HasRowsPerPage;
    use HasSearchableColumns;
    use HasSortableColum;
    use InteractWithPage;

    private string $view = 'little-views::table-components.table';

    protected string $TableTitle = '';

    protected BaseTable $livewire;

    private ?string $livewireId = null;

    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }

    protected function livewireId(string $livewireId): void
    {
        $this->livewireId = $livewireId;
    }

    public function __construct(
        public string $title,
    ) {
    }

    public function configureColumns(BaseTable $livewire, Page $page, string $title = ''): void
    {
        $this->livewire = $livewire;
        $this->livewireId($livewire->id);
        $this->applySearchableColumns();
        $this->applyHeaders();
        $this->tableTitle($title);
        $this->setPagesForResource($page);
        $this->builder($page::getResource()::getEloquentQuery());
        if (count($this->rowActions)) {
            $this->applyDefaultForRowActions();
            $this->actionModal(TableModal::make($this->livewireId . '-action-table'));
        }
        $this->headerActions($this->pageForResource::getActions());
        $this->setLivewireToFilters();

    }

    protected function applyHeaders(): void
    {
        foreach ($this->columns as $column) {
            $this->headers(Header::make($column));
        }
    }

    public static function make(string $title = ''): Table
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return $this->view;
    }

    protected function tableTitle(string $TableTitle): void
    {
        $this->TableTitle = $TableTitle;
    }

    public function getTableTitle(): string
    {
        return $this->TableTitle;
    }

    public function authorizeAccess(): void
    {
        abort_unless($this->getResourcePage()::canViewAny(), 403);

    }

    public function render(): View
    {
        return view($this->getView(), $this->data());
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
