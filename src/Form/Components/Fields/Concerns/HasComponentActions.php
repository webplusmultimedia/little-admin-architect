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

    public function mountActionComponent(string $action, array $arguments = []): void
    {
        if (method_exists($this, $action)) {
            $this->{$action}(...$arguments);

            return;
        }

        throw new Exception("This action [{$action}] doesn't exist");
    }

    public function callActionResult(string $action, array $arguments = []): mixed
    {
        if (method_exists($this, $action)) {
            return $this->{$action}(...$arguments);
        }
        throw new Exception("This action [{$action}] doesn't exist");
    }

    protected function showFormActionComponent(): void
    {
        if ($this->livewire instanceof BaseForm) {
            $this->livewire->mountFormActionComponent = $this->getStatePath();
            $action = $this->formAction;
            $action->beforeFill();
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

    public function saveActionModal(): void
    {
        if ($this->livewire instanceof BaseForm) {
            $action = $this->formAction;
            $action->beforeFill();
            if ( ! $action) {
                throw new Exception('Aucune action trouvée');
            }
            $this->livewire->form->getActionModal()->content(
                FormDialog::make(
                    title: $action->getTitleForModal(),
                    actionLabel: $action->getButtonTitle(),
                    fields: $action->getFields()
                )
            )->setMaxWidth($action->getMaxWidth());

            $action->authorizeAccess();
            $action->handleAction();
            $this->livewire->form->getActionModal()->content(null);
            $this->livewire->dispatchBrowserEvent('close-modal', ['id' => $this->getFormActionId()]);
            $this->livewire->reset([/*'mountFormActionComponent',*/ 'mountFormAction', 'mountFormActionComponentArguments', 'mountFormActionData']);
        }
    }

    protected function getFormActionId(): string
    {
        return $this->livewire->id . $this->suffixEventForm;
    }
}
