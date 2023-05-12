<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeBoolean;

class CheckBox extends Field
{
    use CanBeBoolean;

    protected string $view = 'checkbox';

    protected string $type = 'checkbox';

    public function getType(): string
    {
        return $this->type;
    }

    public function switch(): static
    {
        $this->type = 'switch';

        return $this;
    }
}
