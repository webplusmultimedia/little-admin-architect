<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

trait CanBeSearchable
{
    protected bool $searchable = false;

    public function searchable(): static
    {
        $this->searchable = true;

        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }
}
