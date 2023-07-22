<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\BaseRowAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\DeleteAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\EditAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\RowAction;

trait HasRowActions
{
    /**
     * @var BaseRowAction[]
     */
    protected array $rowActions = [];

    /**
     * @param  BaseRowAction[]  $actions
     */
    public function actions(array $actions = []): static
    {
        $this->rowActions = $actions;

        return $this;
    }

    /**
     * @return BaseRowAction[]
     */
    public function getRowActions(Model $record): array
    {
        foreach ($this->rowActions as $rowAction) {
            $rowAction->livewire($this->livewire);
            $rowAction->record($record);
            if ($rowAction instanceof EditAction) {
                $this->applyRecordToEditAction($rowAction);
            }
            if ($rowAction instanceof DeleteAction) {
                $this->applyRecordToDeleteAction($rowAction);
            }
            if ($rowAction instanceof RowAction) {
                $this->applyWireClickToRowAction($rowAction);
            }

        }

        return $this->rowActions;
    }

    public function hasRowsAction(): int
    {
        return count($this->rowActions);
    }

    protected function applyRecordToEditAction(EditAction $rowAction): void
    {
        if ( ! $rowAction->getRecord() instanceof Model) {
            return;
        }
        if ( ! $this->hasModalForm()) {
            $rowAction->url($this->linkEdit($rowAction->getRecord()));
        } else {
            $rowAction->wireClick("showModalForm({$rowAction->getRecord()->getKey()})");
        }
    }

    protected function applyRecordToDeleteAction(DeleteAction $rowAction): void
    {
        if ( ! $rowAction->getRecord() instanceof Model) {
            return;
        }
        $rowAction->wireClick("mountTableAction('{$rowAction->getName()}',{$rowAction->getRecord()->getKey()})");
    }

    protected function applyDefaultForRowActions(): void
    {
        foreach ($this->rowActions as $rowAction) {
            $rowAction->roundedFull()
                ->small()
                ->bgTransparent();
        }
    }

    public function applyWireClickToRowAction(BaseRowAction $rowAction): void
    {
        if ( ! $rowAction->getRecord() instanceof Model) {
            return;
        }
        $rowAction->wireClick("mountTableAction('{$rowAction->getName()}',{$rowAction->getRecord()->getKey()})");
    }

    public function getActionByName(string $name): ?BaseRowAction
    {
        return collect($this->rowActions)->filter(/**
         * @param  BaseRowAction  $ra
         */ fn ($ra) => $ra->getName() === $name)->first();
    }
}
