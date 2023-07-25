<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\FormModal;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

trait HasActionFormModal
{
    protected FormModal $actionForm;

    protected string $montFormActionComponent = 'mountFormActionComponent';

    protected string $montFormAction = 'mountFormAction';

    protected function actionModal(FormModal $actionModal): static
    {
        $this->setFormActions();
        $this->actionForm = $actionModal;
        if ($this->livewire->{$this->montFormActionComponent}) {
            $action = $this->getActionFormByName($this->livewire->{$this->montFormActionComponent});

            if ($action) {
                $this->actionForm->content(FormDialog::make(
                    title: $action->getTitleForModal(),
                    subtitle: 'fff',
                    actionLabel: $action->getTitleForModal(),
                    fields: $action->getFields()
                ))->setMaxWidth($action->getMaxWidth());
            }
        }

        return $this;
    }

    public function getActionModal(): FormModal
    {
        return $this->actionForm;
    }
}
