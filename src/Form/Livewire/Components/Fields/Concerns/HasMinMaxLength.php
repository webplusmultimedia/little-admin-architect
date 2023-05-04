<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasMinMaxLength
{
    protected null|int $minLength = NULL;
    protected null|int $maxLength = NULL;
    public function minLength(int $length): static
    {
        $this->minLength = $length;
        $this->addRules('min:'.$length);
        return $this;
    }
    public function getMinLength(): ?int
    {
        return $this->minLength;
    }
    public function maxLength(int $length): static
    {
        $this->maxLength = $length;
        $this->addRules('max:'.$length);
        return $this;
    }
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }
}
