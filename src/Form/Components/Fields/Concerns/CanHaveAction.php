<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\FormCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait CanHaveAction
{
    protected ?FormCreateAction $action = null;

    public function getAction(): ?FormCreateAction
    {
        return $this->action;
    }

    /**
     * @param  Field[]  $schemas
     */
    public function createForm(array $schemas): static
    {
        $this->action = FormCreateAction::make()
            ->schemas($schemas);
        $this->hasFormAction = true;

        return $this;
    }
}
