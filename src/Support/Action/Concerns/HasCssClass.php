<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

use Closure;

trait HasCssClass
{
    protected string | Closure $color = 'primary ';

    protected string $btnStyle = '';

    protected ?string $classesStyle = null;

    protected bool $outline = false;

    protected bool $isSmall = true;

    protected bool $roundedFull = true;

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
        $this->color = 'warning ';

        return $this;
    }

    public function info(): static
    {
        $this->color = 'info ';

        return $this;
    }

    public function danger(): static
    {
        $this->color = 'error ';

        return $this;
    }

    public function success(): static
    {
        $this->color = 'success ';

        return $this;
    }

    public function color(string | Closure $color): static
    {
        if (is_string($color)) {
            $color = str($color)
                ->trim()
                ->lower()
                ->append(' ')
                ->value();
        }
        $this->color = $color;

        return $this;
    }

    public function getClass(): string
    {
        $color = $this->getColor();

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

        if ($this->classesStyle) {
            $btnStyle = $btnStyle->prepend($this->classesStyle);
        }

        return $btnStyle->value();
    }

    public function getColor(): string
    {
        if (is_callable($this->color)) {
            return app()->call($this->color, ['record' => $this->getRecord()]);
        }

        return $this->color;
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

    public function classesStyle(string $classesStyle): static
    {
        $this->classesStyle = $classesStyle . ' ';

        return $this;
    }
}
