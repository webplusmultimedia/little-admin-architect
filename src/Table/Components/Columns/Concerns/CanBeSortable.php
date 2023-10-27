<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Closure;

trait CanBeSortable
{
    protected bool | Closure $sortable = false;

    protected string $direction = 'asc';

    public function getDirection(): string
    {
        return $this->direction;
    }

    /** @todo : define sort on closure and array */
    public function sortable(bool | Closure $sort = true): static
    {
        $this->sortable = $sort;

        return $this;
    }

    public function isSortable(): bool
    {

        return $this->evaluate(closure: $this->sortable, include : ['search', 'record']);
    }
}
