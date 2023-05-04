<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Partials\Label;

trait HasLabel
{
    protected ?Label $fieldLabel=null ;
    public function label(null|string $label):static
    {
        $this->label = $label;
        return $this;
    }
    public function getLabel(): ?string
    {
        return $this->label;
    }
    public function getViewComponentForLabel(): string
    {
        return $this->getViewComponent('partials.label') ;
    }

}
