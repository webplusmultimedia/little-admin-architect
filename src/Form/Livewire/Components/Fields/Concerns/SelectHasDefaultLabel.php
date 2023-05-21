<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

trait SelectHasDefaultLabel
{
    protected ?string $defaultLabelForSelect = null;

    public function getLabelDefault(): ?string
    {
        return $this->defaultLabelForSelect;
    }

    public function setDefaultLabelForSelect(Form $form): mixed
    {
        if ($form->hasSelectOptionLabelsUsing() and isset($form->getSelectOptionLabelsUsing()[$this->getWireName()])) {
            $closure = call_user_func($form->getSelectOptionLabelsUsing()[$this->getWireName()],$this->getRecord()?->{$this->getWireName()});
            return $closure;
           // $this->defaultLabelForSelect = $defaultLabelForSelect;
        }
        return null;
    }
}
