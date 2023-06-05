<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait HasColor
{
    protected string $color = 'btn-primary';

    public function warning(): static
    {
        $this->color = 'btn-warning';

        return $this;
    }

    public function danger(): static
    {
        $this->color = 'btn-danger';

        return $this;
    }

    public function success(): static
    {
        $this->color = 'btn-sucess';

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
