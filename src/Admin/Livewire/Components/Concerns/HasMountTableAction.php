<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\ConfirmationDialog;

trait HasMountTableAction
{
    public function mountTableAction(string $method, mixed $key): void
    {
        $this->mountTableAction = $method;
        $this->mountTableActionRecord = $key;

        $id = $this->id . '-action-table';
        $action = $this->table->getActionByName($this->mountTableAction);
        if ( ! $action) {
            throw new Exception('Aucune action trouvée');
        }
        if ($action->isRequireConfirmation()) {
            $this->table->getActionModal()->content(
                ConfirmationDialog::make(title: $this->getTitleForModal($key),
                    subtitle: $action->getConfirmQuestion(),
                    actionLabel: $action->getName()
                )
            )->maxWidthSmall();
        }
        $this->dispatchBrowserEvent('show-modal', ['id' => $id]);
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
                call_user_func($action->getAction(), $record, $this);
            }
        }

        $id = $this->id . '-action-table';
        $this->dispatchBrowserEvent('close-modal', ['id' => $id]);
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
