<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasRecords;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSearchableColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table
{
    use HasColumns;
    use HasHeader;
    use HasRecords;
    use HasSearchableColumns;
    use InteractWithPage;

    private string $view = 'table';

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

    public function setResources(Resources $resources): void
    {
        $this->resources = $resources;
    }

    public function __construct(
        public string $title,
    ) {
    }

    public function configureColumns(string $livewireId, Page $page): void
    {
        $this->livewireId($livewireId)
            ->applySearchableColumns()
            ->applyHeaders()
            ->setPagesForResource($page);
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
}
