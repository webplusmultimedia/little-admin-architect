<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Closure;

trait CanBeSortable
{
    protected bool $sortable = false;
    protected string $direction = 'asc';

    public function getDirection(): string
    {
        return $this->direction;
    }
/** @todo : define sort on closure and array */
    public function sortable(null|array|Closure $sort = null): static
    {
        $this->sortable = true;
        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

}
