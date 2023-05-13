<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

trait HasOptions
{
    protected array $options =[];

    public function options(array $options): static
    {
        $this->options = $options;
        $this->addRules('array');
        $this->addRules('in:'. implode(',',array_keys($options)));
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }


}
