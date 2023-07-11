<?php

declare(strict_types=1);

//declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials\Label;

trait HasLabel
{
    protected ?Label $fieldLabel = null;

    protected ?string $label = null;

    public function label(string $label): static
    {
        $this->label = str($label)->ucfirst()->value();

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label ?? str($this->name)->headline()->lower()->ucfirst()->value();
    }
}
