<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

trait HasMountFormAction
{
    public ?string $mountFormActionComponent = null;

    public array $mountFormActionData = [];

    public mixed $mountFormAction = null;

    protected string $suffixEventForm = '-action-form';

    public function mountFormAction(string $component, mixed $actionName): void
    {
        $id = $this->id . $this->suffixEventForm;
        $this->mountFormActionComponent = $component;
        $this->mountFormAction = $actionName;
        $action = $this->form->getActionFormByName($component);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $action->livewire($this);
        $action->authorizeAccess();

        $this->form->getActionModal()->content(
            FormDialog::make(
                title: $action->getTitleForModal(),
                subtitle: 'fff',
                actionLabel: $action->getTitleForModal(),
                fields: $action->getFields()
            )
        )->setMaxWidth($action->getMaxWidth());
        $this->dispatchBrowserEvent('show-modal', ['id' => $id]);

    }

    public function CallMountFormAction(): void
    {
        $action = $this->form->getActionFormByName($this->mountFormActionComponent);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $id = $this->id . $this->suffixEventForm;
        //$action->livewire($this);
        $action->authorizeAccess();
        $action->handleAction();
        //$this->notification()->success($action->getNotificationText())->send();
        $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
        $this->reset(['mountFormActionComponent', 'mountFormAction', 'mountFormActionData']);

    }
}
