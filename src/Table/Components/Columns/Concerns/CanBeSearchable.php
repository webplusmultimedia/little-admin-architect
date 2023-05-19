<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

trait CanBeSearchable
{

    protected bool $searchable = false;

    public function searchable(): static
    {
        $this->searchable  = true;
        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }


}
