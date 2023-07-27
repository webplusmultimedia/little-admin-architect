<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\GroupAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\BaseRowAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\DeleteAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\EditAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\RowAction;

trait HasRowActions
{
    /**
     * @var array<int,BaseRowAction>|array<int,GroupAction>
     */
    protected array $rowActions = [];

    /**
     * @param  array<int,BaseRowAction>|array<int,GroupAction>  $actions
     */
    public function actions(array $actions = []): static
    {
        $this->rowActions = $actions;

        return $this;
    }

    /**
     * @return array<int,BaseRowAction>|array<int,GroupAction>
     */
    public function getRowActions(Model $record): array
    {
        foreach ($this->rowActions as $rowAction) {
            if ($rowAction instanceof GroupAction) {
                foreach ($rowAction->getActions() as $action) {
                    $this->applySetUp($action, $record);
                }
            } else {
                $this->applySetUp($rowAction, $record);
            }
        }

        return $this->rowActions;
    }

    protected function applySetUp(BaseRowAction $rowAction, Model $model): void
    {
        $rowAction->livewire($this->livewire);
        $rowAction->record($model);
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
            if ($rowAction instanceof GroupAction) {
                foreach ($rowAction->getActions() as $action) {
                    $action->roundedFull()
                        ->small()
                        ->bgTransparent();
                }
            } else {
                $rowAction->roundedFull()
                    ->small()
                    ->bgTransparent();
            }

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
        foreach ($this->rowActions as $rowAction) {
            if ($rowAction instanceof GroupAction) {
                if ($row = $rowAction->getActionByName($name)) {
                    return $row;
                }
            } elseif ($rowAction->getName() === $name) {
                return $rowAction;
            }
        }

        return null;
    }
}
