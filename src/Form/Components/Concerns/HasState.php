<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait HasState
{
    public function getStates(): array
    {
        $datas = [];
        foreach ($this->getFormFields() as $field) {
            /** @todo : remove relations fields for preventing save */
            // $field->hydrateState();
            $name = $field->getName();
            if ( ! is_array($this->model)) {
                $datas[$name] = $this->model->{$name} = $field->getState();
            } else {
                $datas[$name] = $this->model[$name] = $field->getState();
            }
        }

        return $datas;
    }

    public function hydrateState(): void
    {
        foreach ($this->getFormFields() as $field) {
            /** @todo : remove relations fields for preventing save */
            $field->hydrateState();
        }
        $this->getHydrateFormRules();
    }

    public function dehydrateState(): void
    {
        foreach ($this->getFormFields() as $field) {
            /** @todo : remove relations fields for preventing save */
            $field->dehydrateState();
        }
        $this->getDehydrateFormRules();
    }
}
