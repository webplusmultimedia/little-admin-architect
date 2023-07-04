<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBoxList;

trait HasOptions
{
    protected Closure|array $options = [];

    public function options(array|Collection $options): static
    {
        if ($options  instanceof Collection) {
            $options = $options->toArray();
        }
        $this->options = $options;

        if ($this instanceof CheckBoxList) {
            $this->addRules('array');
            $this->addRules('in:' . implode(',', array_keys($options)));
        }

        return $this;
    }

    public function getOptions(): array
    {
        return $this->evaluate($this->options);
    }
}
