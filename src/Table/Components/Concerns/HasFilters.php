<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

trait HasFilters
{
    protected array $filters = [];

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function filters(array $filters): static
    {
        $this->filters = $filters;

        return $this;
    }
}
