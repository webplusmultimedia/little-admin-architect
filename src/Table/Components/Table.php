<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasSearchableColums;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table
{
    use HasColumns;
    use HasHeader;
    use InteractWithPage;
    use HasSearchableColums;

    private string $view = 'table';

    protected array $sortColumns = [];
    private ?LengthAwarePaginator $records = NULL;

    private ?string $livewireId = NULL;



    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }
    public function livewireId(string $livewireId): Table
    {
        $this->livewireId = $livewireId;
        return $this;
    }

    public function records(LengthAwarePaginator $records): Table
    {
        $this->records = $records;
        return $this;
    }

    public function getRecords(): ?LengthAwarePaginator
    {
        return $this->records;
    }

    public function setResources(Resources $resources): void
    {
        $this->resources = $resources;
    }

    public function hasRecords(): bool
    {
        if (! $this->records) {
            return false;
        }

        return $this->records->count() > 0;
    }

    public function __construct(
        public string $title,
    ) {}



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
