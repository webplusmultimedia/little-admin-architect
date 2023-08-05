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

    public function mountFormAction(string $component, string $actionName, mixed $arguments = []): void
    {
        $componentField = $this->form->getFormFieldByPath($component);
        if ($componentField) {
            $componentField->mountActionComponent($actionName, $arguments);
        }

    }

    public function CallMountFormAction(): void
    {
        $action = $this->form->getActionFormByName($this->mountFormActionComponent);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $id = $this->id . $this->suffixEventForm;
        $action->authorizeAccess();
        $action->handleAction();
        //$this->notification()->success($action->getNotificationText())->send();
        $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
        $this->reset([/*'mountFormActionComponent',*/ 'mountFormAction', 'mountFormActionComponentArguments', 'mountFormActionData']);

    }

    public function closeMountFormAction(): void
    {
        $this->reset(['mountFormActionComponent', 'mountFormAction', 'mountFormActionComponentArguments', 'mountFormActionData']);
    }
}
