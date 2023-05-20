<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

class Select extends Field
{
    protected string $view = 'select';
    protected array $options = [];

    public function options(array $options): static
    {
        $this->options = $options;
        $this->addRules('in:' . implode(',', array_keys($options)));

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
