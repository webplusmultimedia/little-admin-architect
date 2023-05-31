<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasId
{
    protected string $id;

    public function getId(): string
    {
        return $this->view . '-' . str($this->getWireName())->replace('.', '-')->slug();
    }
}
