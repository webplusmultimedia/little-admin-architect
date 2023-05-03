<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input;

trait HasMinMaxLength
{
    protected null|int $minLength = NULL;
    protected null|int $maxLength = NULL;
    public function minLength(int $length): Input
    {
        $this->minLength = $length;
        $this->addRules('min:'.$length);
        return $this;
    }
    public function getMinLength(): ?int
    {
        return $this->minLength;
    }
    public function maxLength(int $length): Input
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
