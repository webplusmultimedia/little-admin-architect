<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanSearchWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasOptions;

class Select extends Field
{
    use HasOptions;
    use CanSearchWithLivewire;

    protected string $view = 'select';

    public function options(array $options): static
    {
        $this->options = $options;
        $this->addRules('in:' . implode(',', array_keys($options)));

        return $this;
    }
}
