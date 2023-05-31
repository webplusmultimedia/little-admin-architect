<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasMinMaxValues
{
    private null|int $minValue = null;

    private null|int $maxValue = null;

    public function minValue(int $min): static
    {
        $this->minValue = $min;
        $this->addRules('min:' . $min);

        return $this;
    }

    public function getMinValue(): ?int
    {
        return $this->minValue;
    }

    public function maxValue(int $max): static
    {
        $this->maxValue = $max;
        $this->addRules('max:' . $max);

        return $this;
    }

    public function getMaxValue(): ?int
    {
        return $this->maxValue;
    }
}
