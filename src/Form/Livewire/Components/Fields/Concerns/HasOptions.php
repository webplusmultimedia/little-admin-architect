<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Illuminate\Support\Collection;

trait HasOptions
{
    protected array $options = [];

    public function options(array|Collection $options): static
    {
        $this->options = $options;
        $this->addRules('array');
        $this->addRules('in:' . implode(',', array_keys($options)));

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
