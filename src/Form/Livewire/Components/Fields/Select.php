<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanSearchWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\ContainMessageForComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasOptions;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\SelectHasDefaultLabel;

class Select extends Field
{
    use CanSearchWithLivewire;
    use HasOptions;
    use SelectHasDefaultLabel;
    use ContainMessageForComponent;

    protected string $view = 'select';

    public function options(array|Collection $options): static
    {
        if ($options  instanceof Collection) {
            $options = $options->toArray();
        }
        $this->options = $options;
        $this->addRules('in:' . implode(',', array_keys($options)));

        return $this;
    }
}
