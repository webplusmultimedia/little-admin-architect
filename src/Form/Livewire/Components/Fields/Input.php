<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasMinMaxLength;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasMinMaxValues;

final class Input extends Field
{
    use HasMinMaxLength;
    use HasMinMaxValues;

    /**
     * @var string|null
     */
    protected ?string $type = 'text';

    private null|int|float|string $step = null;

    private null|string $inputMode = null;

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function email(): Input
    {
        $this->type = 'email';
        $this->addRules('email');

        return $this;
    }

    public function numeric(): Input
    {
        $this->type = 'number';
        $this->step(1);
        $this->inputMode = 'numeric';
        $this->addRules('numeric');

        return $this;
    }

    public function decimal(): Input
    {
        $this->type = 'number';
        $this->step = 'any';
        $this->inputMode = 'decimal';
        $this->addRules('numeric');

        return $this;
    }

    public function url()
    {
        $this->type = 'url';
        $this->addRules('url');

        return $this;
    }

    public function step(int|float $step): Input
    {
        $this->step = $step;

        return $this;
    }

    public function getStep(): null|float|int|string
    {
        return $this->step;
    }

    public function inputMode(string $mode): Input
    {
        $this->inputMode = $mode;

        return $this;
    }

    public function getInputMode(): null|string
    {
        return $this->inputMode;
    }
}
