<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait HasColor
{
    protected string $color = 'primary';

    protected string $btnStyle = 'btn-';

    protected bool $outline = false;

    protected bool $isSmall = false;

    protected bool $roundedFull = false;

    public function small(): static
    {
        $this->isSmall = true;
        //$this->btnStyle = str($this->btnStyle)->prepend('btn-small ')->value();
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
        $this->color = 'danger';

        return $this;
    }

    public function success(): static
    {
        $this->color = 'success';

        return $this;
    }

    public function getClass(): string
    {
        if ($this->outline) {
            $this->btnStyle = 'btn-outline btn-outline-' . $this->color;
        } else {
            $this->btnStyle .= $this->color;
        }

        if ($this->roundedFull) {
            $this->btnStyle = str($this->btnStyle)->prepend('btn-rounded ')->value();
        }
        if ($this->isSmall) {
            $this->btnStyle = str($this->btnStyle)->prepend('btn-small ')->value();
        } else {
            $this->btnStyle = str($this->btnStyle)->prepend('btn-medium ')->value();
        }

        return $this->btnStyle;
    }

    public function roundedFull(bool $roundedFull = true): static
    {
        $this->roundedFull = $roundedFull;

        return $this;
    }
}
