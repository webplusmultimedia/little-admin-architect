<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\ContainMessageForComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasOptions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\SelectHasDefaultLabel;

class Select extends Field
{
    use CanSearchWithLivewire;
    use ContainMessageForComponent;
    use HasOptions;
    use SelectHasDefaultLabel;

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
