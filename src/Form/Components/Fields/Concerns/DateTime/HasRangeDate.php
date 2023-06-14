<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime;

trait HasRangeDate
{
    protected ?string $dateTo = null;

    protected ?string $dateFrom = null;

    public function range(): static
    {
        $this->getConfig()->type = 'range';

        return $this;
    }

    public function dateFrom(string $fieldName): static
    {
        $this->dateFrom = $fieldName;

        return $this;
    }

    public function getDateFromWireName(): ?string
    {
        if ( ! $this->dateFrom) {
            return null;
        }

        return $this->getPrefix() . $this->dateFrom;
    }

    public function getDateFromName(): ?string
    {
        return $this->dateFrom;
    }
}
