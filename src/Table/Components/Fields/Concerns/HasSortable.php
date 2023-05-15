<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Fields\Concerns;

use Closure;

trait HasSortable
{
    protected bool $sortable = false;
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
