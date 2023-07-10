<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

trait HasMountFormAction
{
    public ?string $mountFormAction = null;

    public array $mountFormActionData = [];

    public mixed $mountFormActionRecord = null;

    public function mountFormAction(string $method, mixed $key): void
    {
        $id = $this->id . '-action-form';
        $action = $this->form->getActionFormByName($method);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $record = $this->getRecordForMount($key);
        if ($action->isRequireConfirmation()) {
            $this->mountFormAction = $method;
            $this->mountFormActionRecord = $key;
            $action->record($record);
            $this->form->getActionModal()->content(
                FormDialog::make(
                    title: $this->getTitleForModal($key),
                    subtitle: $action->getConfirmQuestion(),
                    actionLabel: $action->getLabel() ?? $action->getName(),
                    record: $record
                )
            )->maxWidthSmall();
            $this->dispatchBrowserEvent('show-modal', ['id' => $id]);
        } else {

            if ($action->getAction()) {
                app()->call($action->getAction(), ['record' => $record, 'livewire' => $this]);
            }
            $this->notification()->success($action->getNotificationText())->send();
        }
    }

    public function CallMountFormAction(): void
    {
        $action = $this->form->getActionByName($this->mountFormAction);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        if ($action->isRequireConfirmation()) {
            $record = $this->getRecordForMount($this->mountFormActionRecord);
            if ($action->getAction()) {
                app()->call($action->getAction(), ['record' => $record, 'livewire' => $this]);
            }
            $id = $this->id . '-action-form';
            $this->notification()->success($action->getNotificationText())->send();
            $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
        }

    }

    private function getRecordForMount(mixed $key): Model
    {

        $model = $this->form->getResourcePage()::getEloquentQuery()->getModel();

        if ( ! $record = $model->where($model->getKeyName(), $key)->first()) {
            throw new Exception('Aucune donnée disponible');
        }

        return $record;
    }

    private function getTitleForModal(mixed $key): mixed
    {
        $record = $this->getRecordForMount($key);
        $field = $this->form->getResourcePage()::getRecordTitleAttribute();

        return $record->{$field};
    }
}
