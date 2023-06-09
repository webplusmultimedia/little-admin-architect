<?php

declare(strict_types=1);

//declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials\Label;

trait HasLabel
{
    //protected ?Label $fieldLabel = null;

    protected ?string $label = null;

    public function label(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        if ($this->label) {
            return str($this->label)->headline()->lower()->ucfirst()->value();
        }

        return str($this->name)->headline()->lower()->ucfirst()->value();
    }

    public function getViewComponentForLabel(): string
    {
        return $this->getViewComponent('partials.label');
    }
}
