<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\FormCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;

trait HasFormFieldsAction
{
    /** @var FormCreateAction[] */
    protected array $formActions = [];

    protected function setFormActions(): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field instanceof Select and $field->hasFormAction()) {
                $this->formActions[$field->getStatePath()] = $field->getFormAction();
            }
        }
    }

    public function getActionFormByName(string $fieldPath): ?FormCreateAction
    {
        foreach ($this->formActions as $name => $action) {
            if ($name === $fieldPath) {
                return $action;
            }
        }

        return null;
    }
}
