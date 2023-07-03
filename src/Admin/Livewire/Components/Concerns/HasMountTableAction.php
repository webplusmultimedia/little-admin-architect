<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\ConfirmationDialog;

trait HasMountTableAction
{
    public ?string $mountTableAction = null;

    public array $mountTableActionData = [];

    public mixed $mountTableActionRecord = null;

    public function mountTableAction(string $method, mixed $key): void
    {
        $id = $this->id . '-action-table';
        $action = $this->table->getActionByName($method);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $record = $this->getRecordForMount($key);
        if ($action->isRequireConfirmation()) {
            $this->mountTableAction = $method;
            $this->mountTableActionRecord = $key;
            $action->record($record);
            $this->table->getActionModal()->content(
                ConfirmationDialog::make(title: $this->getTitleForModal($key),
                    subtitle: $action->getConfirmQuestion(),
                    actionLabel: $action->getLabel() ?? $action->getName()
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

    public function CallMountTableAction(): void
    {
        $action = $this->table->getActionByName($this->mountTableAction);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        if ($action->isRequireConfirmation()) {
            $record = $this->getRecordForMount($this->mountTableActionRecord);
            if ($action->getAction()) {
                app()->call($action->getAction(), ['record' => $record, 'livewire' => $this]);
            }
            $id = $this->id . '-action-table';
            $this->notification()->success($action->getNotificationText())->send();
            $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
        }

    }

    private function getRecordForMount(mixed $key): Model
    {

        $model = $this->table->getResourcePage()::getEloquentQuery()->getModel();

        if ( ! $record = $model->where($model->getKeyName(), $key)->first()) {
            throw new Exception('Aucune donnée disponible');
        }

        return $record;
    }

    private function getTitleForModal(mixed $key): mixed
    {
        $record = $this->getRecordForMount($key);
        $field = $this->table->getResourcePage()::getRecordTitleAttribute();

        return $record->{$field};
    }
}
