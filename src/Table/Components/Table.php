<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Illuminate\Pagination\LengthAwarePaginator;

final class Table
{
    private string $view = 'table';

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

    public static function make(string $title = ''): static
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-table-prefix') . '::' . $this->view;
    }
}
