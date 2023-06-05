<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait HasButton
{
    protected string $type = 'button';

    public function submit(): static
    {
        $this->type = 'submit';

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
