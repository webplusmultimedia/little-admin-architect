<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Closure;

trait HasSelectOptionLabelUsing
{
    /** @var array<string,Closure> */
    protected array $selectOptionLabelsUsing = [];

    /**
     * @return array<string,Closure>
     */
    public function getSelectOptionLabelsUsing(): array
    {
        return $this->selectOptionLabelsUsing;
    }

    public function addSelectOptionLabelsUsing(string $name, Closure $selectOptionLabelsUsing): void
    {
        $this->selectOptionLabelsUsing[$name] = $selectOptionLabelsUsing;
    }

    public function hasSelectOptionLabelsUsing(): bool
    {
        return count($this->selectOptionLabelsUsing) > 0;
    }
}
