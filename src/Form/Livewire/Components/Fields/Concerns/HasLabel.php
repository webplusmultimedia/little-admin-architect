<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials\Label;

trait HasLabel
{
    protected ?Label $fieldLabel = null;

    public function label(null|string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label ?? str($this->name)->headline()->lower()->ucfirst();
    }

    public function getViewComponentForLabel(): string
    {
        return $this->getViewComponent('partials.label');
    }
}
