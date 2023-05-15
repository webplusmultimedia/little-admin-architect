<?php

declare(strict_types=1);

//declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials\Label;

trait HasLabel
{
    protected ?Label $fieldLabel = null;

    protected ?string $label = null;

    public function label(null|string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): null|string
    {
        return $this->label ?? str($this->name)->headline()->lower()->ucfirst()->value();
    }

   /* public function getViewComponentForLabel(): string
    {
        return $this->getViewComponent('partials.label');
    }*/
}
