<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

trait HasType
{
    protected string $type = '';

    public function getType(): string
    {
        return $this->type;
    }

    public function switch(): static
    {
        $this->type = 'switch';
        return $this;
    }
}
