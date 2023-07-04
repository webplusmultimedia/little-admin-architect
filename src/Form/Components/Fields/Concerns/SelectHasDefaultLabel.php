<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait SelectHasDefaultLabel
{
    protected ?string $defaultLabelForSelect = null;

    public function getLabelDefault(): ?string
    {
        return $this->defaultLabelForSelect;
    }

    public function setDefaultLabelForSelect(Form $form): void
    {
        if ($form->hasSelectOptionLabelsUsing() and isset($form->getSelectOptionLabelsUsing()[$this->getStatePath()])) {
            if ($this->hasRelationship()) {
                $this->defaultLabelForSelect = app()->call($form->getSelectOptionLabelsUsing()[$this->getStatePath()], ['component' => $this, 'state' => $this->getState()]);
            } else {
                $this->defaultLabelForSelect = call_user_func($form->getSelectOptionLabelsUsing()[$this->getStatePath()], $this->getState());
            }
        }
    }
}
