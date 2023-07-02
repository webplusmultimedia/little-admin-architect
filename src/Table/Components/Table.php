<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\Modal;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasActionModal;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeaderAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasQueryBuilder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRecords;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowActions;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowsPerPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSearchableColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSortableColum;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table implements Htmlable
{
    use HasActionModal;
    use HasColumns;
    use HasHeader;
    use HasHeaderAction;
    use HasQueryBuilder;
    use HasRecords;
    use HasRowActions;
    use HasRowsPerPage;
    use HasSearchableColumns;
    use HasSortableColum;
    use InteractWithPage;

    private string $view = 'table';

    protected string $TableTitle = '';

    protected Component $livewire;

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

    public function configureColumns(Component $livewire, Page $page, string $title = ''): void
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
            $this->actionModal(Modal::make($this->livewireId . '-action-table'));
        }
        $this->headerActions($this->pageForResource::getActions());

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
        return 'little-views::table-components.' . $this->view;
    }

    protected function tableTitle(string $TableTitle): void
    {
        $this->TableTitle = $TableTitle;
    }

    public function getTableTitle(): string
    {
        return $this->TableTitle;
    }

    protected function render(): View
    {
        return view($this->getView(), ['table' => $this]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
