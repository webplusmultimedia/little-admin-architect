<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasTranslation
{
    protected bool $isTranslate = false;

    public function translated(): static
    {
        $this->isTranslate = true;
        return $this;
    }

    public function HasTranslated(): bool
    {
        return $this->isTranslate;
    }
}
