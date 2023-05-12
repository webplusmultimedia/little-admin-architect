<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Illuminate\Validation\Rule;

trait HasOptions
{
    protected array $options =[];

    public function options(array $options): static
    {
        $this->options = $options;
        $this->addRules(Rule::in($options));
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }


}
