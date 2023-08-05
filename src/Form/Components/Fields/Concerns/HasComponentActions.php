<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Exception;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

trait HasComponentActions
{
    protected string $suffixEventForm = '-action-form';

    protected string $montFormActionComponent = 'mountFormActionComponent';

    protected string $montFormActionComponentArguments = 'mountFormActionComponentArguments';

    public function mountActionComponent(string $action, mixed $arguments = null): void
    {
        if (method_exists($this, $action)) {
            $this->{$action}(...$arguments);
        }
    }

    protected function showFormActionComponent(): void
    {
        if ($this->livewire instanceof BaseForm) {
            $this->livewire->mountFormActionComponent = $this->getStatePath();
            $action = $this->livewire->form->getActionFormByName($this->getStatePath());
            if ( ! $action) {
                throw new Exception('Aucune action trouvée');
            }
            $action->authorizeAccess();

            $this->livewire->form->getActionModal()->content(
                FormDialog::make(
                    title: $action->getTitleForModal(),
                    actionLabel: $action->getButtonTitle(),
                    fields: $action->getFields()
                )
            )->setMaxWidth($action->getMaxWidth());
            $this->livewire->dispatchBrowserEvent('show-modal', ['id' => $this->getFormActionId()]);
        }

    }

    protected function getFormActionId(): string
    {
        return $this->livewire->id . $this->suffixEventForm;
    }
}
