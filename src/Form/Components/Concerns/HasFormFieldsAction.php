<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats\FormAction;

trait HasFormFieldsAction
{
    /** @var FormAction[] */
    protected array $formActions = [];

    protected function setFormActions(): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field->hasFormAction() and $action = $field->getFormAction()) {
                $action->livewire(livewire: $this->livewire);
                $this->formActions[$field->getStatePath()] = $action;
            }
        }
    }

    public function getActionFormByName(string $fieldPath): ?FormAction
    {
        foreach ($this->formActions as $name => $action) {
            if ($name === $fieldPath) {
                return $action;
            }
        }

        return null;
    }
}
