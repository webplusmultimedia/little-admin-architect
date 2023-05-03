<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

class Input extends Field
{
    protected string $view = 'form::input';
    protected null|int $min = NULL;
    protected null|int $max = NULL;
    protected ?string $type = 'text';
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }
    public function min(int $min): Input
    {
        $this->min = $min;
        $this->addRules('min:'.$min);

        return $this;
    }
    public function getMinValue(): ?int
    {
        return $this->min;
    }
    public function max(int $max): Input
    {
        $this->max = $max;
        $this->addRules('max:'.$max);
        return $this;
    }

    public function getMaxValue(): ?int
    {
        return $this->max;
    }
    public function email(): Input
    {
        $this->type = 'email';
        $this->addRules('email');
        return $this;
    }
    public function getFieldView(): string
    {
        return $this->view;
    }

}
