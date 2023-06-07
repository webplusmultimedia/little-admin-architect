<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait HasColor
{
    protected string $color = 'primary';

    protected string $btnStyle= 'btn-';
    protected bool $outline = false;

    protected bool $roundedFull = false;

    public function outline(): static
    {
        $this->outline = true;
        $this->btnStyle = 'btn-outline-';

        return $this;
    }
    public function warning(): static
    {
        $this->color = 'warning';

        return $this;
    }

    public function danger(): static
    {
        $this->color = 'danger';

        return $this;
    }

    public function success(): static
    {
        $this->color = 'success';

        return $this;
    }

    public function getColor(): string
    {
        if ($this->roundedFull){
            $this->btnStyle = str($this->btnStyle)->prepend('btn-rounded ')->value();
        }
        return $this->btnStyle . $this->color;
    }


    public function roundedFull(bool $roundedFull = true): HasColor
    {
        $this->roundedFull = $roundedFull;

        return $this;
}
}
