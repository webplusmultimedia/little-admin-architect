<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\FormCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasFormAction
{
    protected ?FormCreateAction $formAction = null;

    public function getFormAction(): ?FormCreateAction
    {
        return $this->formAction;
    }

    public function hasFormAction(): bool
    {
        return null !== $this->formAction;
    }

    /**
     * @param  Field[]  $schemas
     */
    public function createOptionForm(array $schemas): static
    {
        $this->formAction = FormCreateAction::make('create-option')
            ->schemas(fields: $schemas);
        $this->hasFormAction = true;

        return $this;
    }
}
