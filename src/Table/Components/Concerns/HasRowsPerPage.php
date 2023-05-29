<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

trait HasRowsPerPage
{
    protected int $rowsPerPage = 0;

    public function rowsPerPages(int $rowsPerPage): static
    {
        $this->rowsPerPage = abs($rowsPerPage);

        return $this;
    }

    public function getRowsPerPage(): int
    {
        if ( ! $this->rowsPerPage) {
            $this->rowsPerPage = config('little-admin-architect.table.rowsPerPage');
        }

        return $this->rowsPerPage;
    }
}
