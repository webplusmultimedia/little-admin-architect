<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;

class Radio extends Field
{
    use HasGridColumns;

    protected string $view = 'radio';

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
