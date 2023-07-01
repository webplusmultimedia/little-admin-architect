<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasName
{
    protected string $name;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWireName(): string
    {
        return $this->getPrefix() . $this->name;
    }
    public function getStatePath(): string
    {
        return $this->getPrefix() . $this->name;
    }

    protected function getPrefix(): string
    {
        if ($this->record instanceof Model) {
            return $this->prefixName . '.';
        }

        return '';
    }
}
