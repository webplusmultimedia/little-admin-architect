<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

trait HasMountFormAction
{
    public ?string $mountFormActionComponent = null;

    public array $mountFormActionData = [];

    public mixed $mountFormAction = null;

    protected string $suffixEventForm = '-action-form';

    public function mountFormAction(string $component, string $actionName): void
    {
        $id = $this->id . $this->suffixEventForm;
        $action = $this->form->getActionFormByName($component);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $action->livewire($this);
        $action->authorizeAccess();

        $this->mountFormActionComponent = $component;
        $this->mountFormAction = $actionName;
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
        $action->livewire($this);
        $action->authorizeAccess();
        $action->handleAction();
        $this->notification()->success($action->getNotificationText())->send();
        $this->dispatchBrowserEvent('close-modal', ['id' => $id]);

    }

    private function getRecordForMount(mixed $key): Model
    {

        $model = $this->form->getResourcePage()::getEloquentQuery()->getModel();

        if ( ! $record = $model->where($model->getKeyName(), $key)->first()) {
            throw new Exception('Aucune donnée disponible');
        }

        return $record;
    }
}
