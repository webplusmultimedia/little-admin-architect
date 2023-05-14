<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasColSpan
{
    protected string $colSpan = 'lg:col-span-1';

    public function colSpan(int $span): static
    {
        $this->colSpan = 'lg:col-span-' . $span;

        return $this;
    }

    public function colSpanFull(): static
    {
        $this->colSpan = 'lg:col-span-full';

        return $this;
    }

    public function getColSpan(): string
    {
        return $this->colSpan;
    }
}
