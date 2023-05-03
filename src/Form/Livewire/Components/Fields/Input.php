<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasMinMax;

final class Input extends Field
{
    use HasMinMax;


    protected ?string $type = 'text';
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }
    public function email(): Input
    {
        $this->type = 'email';
        $this->addRules('email');
        return $this;
    }


}
