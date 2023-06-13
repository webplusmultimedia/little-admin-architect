<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\DateTime;

trait HasRangeDate
{
    protected ?string $dateTo = null;

    protected ?string $dateFrom = null;

    public function dateFrom(string $dateFrom): static
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateFromWireName(): string
    {
        return $this->getPrefix() . $this->dateFrom;
    }
}
