<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

trait HasLabel
{
    protected string|null $label = null;

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    protected function getLabel(): ?string
    {
        if ( ! $this->label) {
            $this->label = str($this->name)->headline()->value();
        }

        return $this->label;
    }
}
