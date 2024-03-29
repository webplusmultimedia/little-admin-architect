<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait CanBeWireModifier
{
    protected ?string $wireModifier = '.defer';

    /**
     * @return bool
     */
    protected bool $isWireLazy = false;

    public function reactive(bool $isReactive = true): static
    {
        if ( ! $isReactive) {
            $this->wireModifier = null;
            $this->isWireLazy = false;

            return $this;
        }
        $this->wireModifier = '.lazy';
        $this->isWireLazy = true;

        return $this;
    }

    public function defer(): static
    {
        $this->wireModifier = '.defer';

        return $this;
    }

    public function isWireLazy(): bool
    {
        return $this->isWireLazy;
    }

    public function getWireModifier(): ?string
    {
        return $this->wireModifier;
    }
}
