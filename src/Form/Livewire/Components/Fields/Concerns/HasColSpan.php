<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasColSpan
{
    protected int|string $colSpan = 'col-span-1';
    public function colSpan(int $span): static
    {
        $this->colSpan = 'col-span-'. $span;
        return $this;
    }

    public function colSpanFull(): static
    {
        $this->colSpan = 'col-span-full';
        return $this;
    }

    public function getColSpan()
    {
        return $this->colSpan;
    }
}
