<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasColumns;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasHeader;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;

final class Table
{
    use HasColumns;
    use HasHeader;
    private string $view = 'table';

    protected array $sortColumns = [];

    private ?LengthAwarePaginator $records = null;

    private ?string $livewireId = null;

    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }

    public function records(LengthAwarePaginator $records): void
    {
        $this->records = $records;
    }

    public function getRecords(): ?LengthAwarePaginator
    {
        return $this->records;
    }

    public function hasRecords(): bool
    {
        if ( ! $this->records) {
            return false;
        }

        return $this->records->count() > 0;
    }

    public function __construct(
        public string $title,
    ) {

    }

    protected function applyHeaders(): void
    {
        foreach ($this->columns as $column) {
            $this->headers(Header::make(name: $column->getName(),sortable: $column->isSortable()));
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
}
