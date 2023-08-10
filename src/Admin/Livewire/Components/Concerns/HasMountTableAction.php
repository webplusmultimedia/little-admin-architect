<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\ConfirmationDialog;

trait HasMountTableAction
{
    public ?string $mountTableAction = null;

    public ?string $mountTableActionComponent = null;

    public array $mountTableActionComponentArguments = [];

    public array $mountTableActionData = [];

    public mixed $mountTableActionRecord = null;

    public function mountTableAction(string $method, mixed $key): void
    {
        $id = $this->id . '-action-table';
        $action = $this->table->getActionByName($method);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        $action->livewire($this);
        $record = $this->getRecordForMount($key);
        $action->record($record);
        $action->authorizeAccess();
        if ($action->isRequireConfirmation()) {
            $this->mountTableAction = $method;
            $this->mountTableActionRecord = $key;

            $this->table->getActionModal()->content(
                ConfirmationDialog::make(
                    title: $this->getTitleForModal($record),
                    subtitle: $action->getConfirmQuestion(),
                    actionLabel: $action->getLabel() ?? $action->getName(),
                    btnClass: $action->getColor(),
                )
            )->maxWidthSmall();
            $this->dispatchBrowserEvent('show-modal', ['id' => $id]);
        } else {
            $action->handleAction();
            $this->notification()->success($action->getNotificationText())->send();
        }
    }

    public function CallMountTableAction(): void
    {
        $action = $this->table->getActionByName($this->mountTableAction);
        $id = $this->id . '-action-table';
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }

        if ($action->isRequireConfirmation()) {
            $record = $this->getRecordForMount($this->mountTableActionRecord);
            $action->record($record);
            $action->livewire($this);
            $action->authorizeAccess();
            $action->handleAction();
            $this->notification()->success($action->getNotificationText())->send();
            $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
        }
        $this->mountTableActionRecord = null;
        $this->mountTableAction = null;
        $this->mountTableActionData = [];

    }

    private function getRecordForMount(mixed $key): Model
    {
        $model = $this->table->getResourcePage()::getEloquentQuery()->getModel();
        if ( ! $record = $model->where($model->getKeyName(), $key)->first()) {
            throw new Exception('Aucune donnée disponible');
        }

        return $record;
    }

    private function getTitleForModal(Model $record): mixed
    {
        $fieldName = $this->table->getResourcePage()::getRecordTitleAttribute();

        return $record->{$fieldName};
    }

    public function closeMountTableAction(): void
    {
        $this->reset(['mountTableAction',
            'mountTableActionData',
            'mountTableActionRecord']);
    }
}
