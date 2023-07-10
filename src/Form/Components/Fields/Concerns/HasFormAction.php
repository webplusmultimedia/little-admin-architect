<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\FormCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasFormAction
{
    protected ?FormCreateAction $formAction = null;

    public function getFormAction(FormCreateAction $formAction): FormCreateAction
    {
        return $this->formAction = $formAction;
    }

    protected function hasFormAction(): bool
    {
        return null !== $this->formAction;
    }

    /**
     * @param  Field[]  $schemas
     */
    public function createOptionForm(array $schemas): static
    {
        $this->formAction = FormCreateAction::make()
            ->schemas(fields: $schemas);

        return $this;
    }
}
