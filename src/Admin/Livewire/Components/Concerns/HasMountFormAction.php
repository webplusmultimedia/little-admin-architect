<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;

trait HasMountFormAction
{
    public ?string $mountFormActionComponent = null;

    public array $mountFormActionComponentArguments = [];

    public array $mountFormActionData = [];

    public string|null $mountFormAction = null;

    protected string $suffixEventForm = '-action-form';

    public function mountFormAction(string $component, string $actionName, array $arguments = []): void
    {
        $componentField = $this->form->getFormFieldByPath($component);
        if ($componentField) {
            $componentField->mountActionComponent(action: $actionName, arguments: $arguments);
        } else {
            throw new Exception("This Component [{$component}] doesn't exist");
        }

    }

    public function CallMountFormAction(): void
    {
        $componentField = $this->form->getFormFieldByPath($this->mountFormActionComponent);
        if ($componentField) {
            $componentField->mountActionComponent(action: 'saveActionModal');
        } else {
            throw new Exception("This Component [{$this->mountFormActionComponent}] doesn't exist");
        }

        // $action = $this->form->getActionFormByName($this->mountFormActionComponent);
        //        if (! $action) {
        //            throw new Exception('Aucune action trouvée');
        //        }
        //        $id = $this->id . $this->suffixEventForm;
        //        $action->authorizeAccess();
        //        $action->handleAction();
        //        //$this->notification()->success($action->getNotificationText())->send();
        //        $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
        //        $this->reset([/*'mountFormActionComponent',*/ 'mountFormAction', 'mountFormActionComponentArguments', 'mountFormActionData']);

    }

    public function closeMountFormAction(): void
    {
        $this->reset(['mountFormActionComponent', 'mountFormAction', 'mountFormActionComponentArguments', 'mountFormActionData']);
    }
}
