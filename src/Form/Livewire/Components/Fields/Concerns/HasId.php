<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasId
{
    protected string $id;

    public function getId(): string
    {
        return $this->view . '-' . str($this->getWireName())->replace('.', '-')->slug();
    }
}
