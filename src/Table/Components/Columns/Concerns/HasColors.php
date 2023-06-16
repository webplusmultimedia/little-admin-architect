<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

trait HasColors
{
    /**
     * @var array<string,string>|null
     */
    protected ?array $valuesForTextColor = null;

    protected ?array $valuesForBgColor = null;

    public function color(array $valuesForColor): static
    {
        $this->valuesForTextColor = $valuesForColor;

        return $this;
    }

    public function bgColor(array $bgColor): static
    {
        $this->valuesForBgColor = $bgColor;

        return $this;
    }

    public function hasTextColor(): bool
    {
        return is_array($this->valuesForTextColor);
    }

    public function hasBgColor(): bool
    {
        return is_array($this->valuesForBgColor);
    }

    public function getColor(?string $value): string|null
    {
        if ($value) {
            if ($this->hasTextColor() and isset($this->valuesForTextColor[$value])) {
                return str('text-')->append($this->valuesForTextColor[$value])->value();
            }
            if ($this->hasBgColor() and isset($this->valuesForBgColor[$value])) {
                return str('text-tag-')->append($this->valuesForBgColor[$value])->value();
            }
        }

        return null;
    }
}
