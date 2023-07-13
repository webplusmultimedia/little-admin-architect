<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

trait HasName
{
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    protected function getName(): string
    {
        return $this->name;
    }
}
