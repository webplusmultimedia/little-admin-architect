<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats\FormAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\CreateAction;

trait HasHeaderAction
{
    /** @var FormAction[] $headerActions */
    protected array $headerActions = [];

    /** @param FormAction[] $headerActions */
    public function headerActions(array $headerActions): static
    {
        foreach ($headerActions as $headerAction) {
            if ($headerAction instanceof CreateAction) {
                $headerAction->label(
                    str(__('little-admin-architect::table.button.create', ['label' => 'un ']))->append($this->title)->singular()->value()
                );
                $headerAction->success();
                $headerAction->url($this->linkCreate());
            }
        }
        $this->headerActions = $headerActions;

        return $this;
    }

    /** @return  FormAction[] */
    public function getHeaderActions(): array
    {
        return $this->headerActions;
    }
}
