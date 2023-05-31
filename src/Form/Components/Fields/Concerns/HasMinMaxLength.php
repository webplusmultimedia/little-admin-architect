<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasMinMaxLength
{
    protected null|int $minLength = null;

    protected null|int $maxLength = null;

    public function minLength(int $length): static
    {
        $this->minLength = $length;
        $this->addRules('min:' . $length);

        return $this;
    }

    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    public function maxLength(int $length): static
    {
        $this->maxLength = $length;
        $this->addRules('max:' . $length);

        return $this;
    }

    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }
}
