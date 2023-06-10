<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\Modal;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasActionModal;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasEditAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasQueryBuilder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRecords;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowActions;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowsPerPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSearchableColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSortableColum;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table
{
    use HasActionModal;
    use HasColumns;
    use HasEditAction;
    use HasHeader;
    use HasQueryBuilder;
    use HasRecords;
    use HasRowActions;
    use HasRowsPerPage;
    use HasSearchableColumns;
    use HasSortableColum;
    use InteractWithPage;

    private string $view = 'table';

    protected string $TableTitle = '';

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

    public function configureColumns(string $livewireId, Page $page, string $title = ''): void
    {
        $this->livewireId($livewireId);
        $this->applySearchableColumns();
        $this->applyHeaders();
        $this->tableTitle($title);
        $this->setPagesForResource($page);
        $this->builder($page::getResource()::getEloquentQuery());
        if (count($this->rowActions)) {
            $this->applyDefaultForRowActions();
            $this->actionModal(Modal::make($this->livewireId . '-action-table'));
        }
        $this->editAction($this->pageForResource::getActions());
        dd($this->editAction);

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
        return config('little-admin-architect.blade-table-prefix') . '::' . $this->view;
    }

    protected function tableTitle(string $TableTitle): void
    {
        $this->TableTitle = $TableTitle;
    }

    public function getTableTitle(): string
    {
        return $this->TableTitle;
    }
}
