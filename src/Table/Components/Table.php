<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
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

    private string $view = 'table';
    protected string $TableTitle = '';

    protected array $sortColumns = [];

    private ?string $livewireId = null;

    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }

    public function livewireId(string $livewireId): Table
    {
        $this->livewireId = $livewireId;

        return $this;
    }

    public function __construct(
        public string $title,
    ) {
    }

    public function configureColumns(string $livewireId, Page $page,string $title=''): void
    {
        $this->livewireId($livewireId)
            ->applySearchableColumns()
            ->applyHeaders()
            ->tableTitle($title)
            ->setPagesForResource($page)
       ;
    }

    public function applyHeaders(): Table
    {
        foreach ($this->columns as $column) {
            $this->headers(Header::make($column));
        }

        return $this;
    }

    public static function make(string $title = ''): Table
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $this->view;
    }

    /**
     * @param string $TableTitle
     *
     * @return Table
     */
    public function tableTitle(string $TableTitle): Table
    {
        $this->TableTitle = $TableTitle;

        return $this;
}

    /**
     * @return string
     */
    public function getTableTitle(): string
    {
        return $this->TableTitle;
    }
}
