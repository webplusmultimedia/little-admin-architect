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
    protected array $editAction = [];

    /**
     * @param  TableAction[]  $editActions
     */
    public function editAction(array $editActions): static
    {
        foreach ($editActions as $editAction) {
            if ($editAction instanceof EditAction) {
                $editAction->url($this->linkIndex());
            }
        }
        $this->editAction = $editActions;

        return $this;
    }
}
