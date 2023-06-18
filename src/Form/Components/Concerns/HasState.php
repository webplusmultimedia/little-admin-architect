<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait HasState
{
    public function getState(): array
    {
        $datas = [];
        foreach ($this->getFormFields() as $field) {
            /** @todo : remove relations fields for preventing save */
            $field->hydrateState();
            $name = $field->getName();
            if ( ! is_array($this->model)) {
                $datas[$field->getName()] = $this->model->{$name} = $field->dehydrateState() ?? $field->getState();
            } else {
                $datas[$field->getName()] = $this->model[$name] = $field->dehydrateState() ?? $field->getState();
            }
        }

        return $datas;
    }
}