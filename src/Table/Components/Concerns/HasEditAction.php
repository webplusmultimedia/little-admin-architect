<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction\EditAction;

trait HasEditAction
{
    /**
     * @var TableAction[]
     */
    protected array $editActions = [];

    /**
     * @param  TableAction[]  $editActions
     */
    public function editActions(array $editActions): static
    {
        foreach ($editActions as $editAction) {
            if ($editAction instanceof EditAction) {
                $editAction->label(
                    str(__('little-admin-architect::table.button.create', ['label' => 'un ']))->append($this->title)->singular()->value()
                );
                if ($this->hasModalForm()) {
                    $editAction->wireClick('showModalForm()');
                } else {
                    $editAction->url($this->linkCreate());
                }
            }
        }
        $this->editActions = $editActions;

        return $this;
    }

    /**
     * @return TableAction[]
     */
    public function getEditActions(): array
    {
        return $this->editActions;
    }
}
