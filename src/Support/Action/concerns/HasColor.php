<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Closure;

trait HasColor
{
    protected string|Closure $color = 'primary ';

    protected string $btnStyle = '';

    protected bool $outline = false;

    protected bool $isSmall = false;

    protected bool $roundedFull = false;

    protected bool $isBgTransparent = false;

    public function small(): static
    {
        $this->isSmall = true;

        return $this;
    }

    public function outline(): static
    {
        $this->outline = true;

        return $this;
    }

    public function warning(): static
    {
        $this->color = 'warning';

        return $this;
    }

    public function danger(): static
    {
        $this->color = 'danger ';

        return $this;
    }

    public function success(): static
    {
        $this->color = 'success ';

        return $this;
    }

    public function color(Closure $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getClass(): string
    {
        $color = $this->color;
        if (is_callable($this->color)) {
            $color = call_user_func($this->color, $this->getRecord());
        }

        if ($this->outline) {
            $this->btnStyle = 'btn-outline btn-outline-' . $color;
        } else {
            $this->btnStyle = 'btn-' . $color . ' text-white ';
        }
        if ($this->isBgTransparent) {
            $this->btnStyle = 'btn-transparent btn-text-' . $color;
        }

        $btnStyle = str($this->btnStyle);


        if ($this->roundedFull) {
            $btnStyle = $btnStyle->prepend('btn-rounded ');
        }
        if ($this->isSmall) {
            $btnStyle = $btnStyle->prepend('btn-small ');
        } else {
            $btnStyle = $btnStyle->prepend('btn-medium ');
        }

        return $btnStyle->value();
    }

    public function bgTransparent(): static
    {
        $this->isBgTransparent = true;

        return $this;
    }

    public function roundedFull(bool $roundedFull = true): static
    {
        $this->roundedFull = $roundedFull;

        return $this;
    }
}
