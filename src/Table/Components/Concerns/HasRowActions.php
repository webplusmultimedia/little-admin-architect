<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\DeleteAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\EditAction;

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
            if ($rowAction instanceof EditAction) {
                $this->applyRecordToEditAction($record, $rowAction);
            }
            if ($rowAction instanceof DeleteAction) {
                $this->applyRecordToDeleteAction($record, $rowAction);
            }

        }

        return $this->rowActions;
    }

    protected function applyRecordToEditAction(Model $record, EditAction $rowAction): void
    {
        if ( ! $this->hasModalForm()) {
            $rowAction->url($this->linkEdit($record));
        } else {
            $rowAction->wireClick("showModalForm({$record->getKey()})");
        }
    }

    protected function applyRecordToDeleteAction(Model $record, DeleteAction $rowAction): void
    {
        $rowAction->wireClick("mountTableAction('{$rowAction->getName()}',{$record->getKey()})");
    }

    public function getActionByName(string $name): ?Action
    {
        return collect($this->rowActions)->filter(/**
         * @param  Action  $ra
         */ fn ($ra) => $ra->getName() === $name)->first();
    }
}
