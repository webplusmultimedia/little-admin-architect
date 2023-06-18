<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction\CreateAction;

trait HasHeaderAction
{
    /**
     * @var TableAction[]
     */
    protected array $headerActions = [];

    /**
     * @param  TableAction[]  $headerActions
     */
    public function headerActions(array $headerActions): static
    {
        foreach ($headerActions as $headerAction) {
            if ($headerAction instanceof CreateAction) {
                $headerAction->label(
                    str(__('little-admin-architect::table.button.create', ['label' => 'un ']))->append($this->title)->singular()->value()
                );
                if ($this->hasModalForm()) {
                    $headerAction->wireClick('showModalForm()');
                } else {
                    $headerAction->url($this->linkCreate());
                }
            }
        }
        $this->headerActions = $headerActions;

        return $this;
    }

    /**
     * @return TableAction[]
     */
    public function getHeaderActions(): array
    {
        return $this->headerActions;
    }
}
