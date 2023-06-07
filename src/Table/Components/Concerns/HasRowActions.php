<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\EditAction;

trait HasRowActions
{
    /**
     * @var Action[]
     */
    protected array $rowActions =[];

    /**
     * @param Action[] $actions
     *
     * @return static
     */
    public function actions(array $actions = []): static
    {
        $this->rowActions = $actions;
        return $this;
    }

    public function getRowActions(): array
    {
        return $this->rowActions;
    }

    public function getEditAction( ): ?Action
    {
        foreach ($this->rowActions as $rowAction) {
            if ($rowAction instanceof EditAction){
               return $rowAction;
            }
        }
        return NULL;
    }
}
