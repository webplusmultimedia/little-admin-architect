<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Illuminate\Support\Collection;

trait HasOptions
{
    protected Closure | array $options = [];

    public function options(array | Collection | Closure $options): static
    {
        if ($options  instanceof Collection) {
            $options = $options->toArray();
        }
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->evaluate($this->options);
    }
}
