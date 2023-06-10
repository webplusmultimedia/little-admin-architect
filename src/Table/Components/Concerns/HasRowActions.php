<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\DeleteAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\EditAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\RowAction;

trait HasRowActions
{
    /**
     * @var Action[]
     */
    protected array $rowActions = [];

    /**
     * @param  Action[]  $actions
     */
    public function actions(array $actions = []): static
    {
        $this->rowActions = $actions;

        return $this;
    }

    /**
     * @return Action[]
     */
    public function getRowActions(Model $record): array
    {
        foreach ($this->rowActions as $rowAction) {
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

    protected function applyRecordToEditAction( EditAction $rowAction): void
    {
        if ( ! $this->hasModalForm()) {
            $rowAction->url($this->linkEdit($rowAction->getRecord()));
        } else {
            $rowAction->wireClick("showModalForm({$rowAction->getRecord()->getKey()})");
        }
    }

    protected function applyRecordToDeleteAction( DeleteAction $rowAction): void
    {
        $rowAction->wireClick("mountTableAction('{$rowAction->getName()}',{$rowAction->getRecord()->getKey()})");
    }

    protected function applyDefaultForRowActions(): void
    {
        foreach ($this->rowActions as $rowAction) {
            $rowAction->roundedFull()
                ->small()
                ->outline();
        }
    }

    public function applyWireClickToRowAction(RowAction $rowAction) {
        $rowAction->wireClick("mountTableAction('{$rowAction->getName()}',{$rowAction->getRecord()->getKey()})");
    }
    public function getActionByName(string $name): ?Action
    {
        return collect($this->rowActions)->filter(/**
         * @param  Action  $ra
         */ fn ($ra) => $ra->getName() === $name)->first();
    }
}
