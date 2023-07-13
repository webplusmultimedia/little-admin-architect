<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

trait HasStatePath
{
    protected string $prefixPath = 'tableFilters';

    protected ?string $path = null;

    protected function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    protected function setPrefixPath(): static
    {
        $this->field->setPrefixPath($this->prefixPath);

        return $this;
    }
}
