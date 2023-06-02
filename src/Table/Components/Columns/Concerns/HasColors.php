<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

trait HasColors
{
    /**
     * @var array<string,string>|null
     */
    protected ?array $valuesForColor = null;

    public function color(array $valuesForColor): static
    {
        $this->valuesForColor = $valuesForColor;

        return $this;
    }

    public function hasColors(): bool
    {
        return is_array($this->valuesForColor);
    }

    public function getColor($value): string|null
    {

        if ($this->hasColors() and isset($this->valuesForColor[$value])) {
            return str('text-')->append($this->valuesForColor[$value], '-500')->value();
        }

        return null;
    }
}
