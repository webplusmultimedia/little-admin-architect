<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasQueryBuilder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRecords;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRowsPerPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSearchableColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSortableColum;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table
{
    use HasColumns;
    use HasHeader;
    use HasRecords;
    use HasSearchableColumns;
    use InteractWithPage;
    use HasSortableColum;
    use HasRowsPerPage;
    use HasQueryBuilder;

    private string $view = 'table';
    protected string $TableTitle = '';


    private ?string $livewireId = NULL;

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
    ) {}

    public function configureColumns(string $livewireId, Page $page, string $title = ''): void
    {
        $this->livewireId($livewireId);
        $this->applySearchableColumns();
        $this->applyHeaders();
        $this->tableTitle($title);
        $this->setPagesForResource($page);
        $this->builder($page::getResource()::getEloquentQuery());
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
