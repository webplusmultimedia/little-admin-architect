<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Pagination\LengthAwarePaginator;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;

trait HasRecords
{
    protected ?LengthAwarePaginator $records = null;

    public function records(LengthAwarePaginator $records): Table
    {
        $this->records = $records;

        return $this;
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
}
