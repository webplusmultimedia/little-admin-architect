<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanValidatedValues
{
    public function values(array $datas): array
    {
        $values = [];
        if ($this->bind instanceof Model) {
            foreach ($this->fields as $field) {
                $values = $field->getValidatedValues(values: $values, datas: $datas, model: $this->bind);
            }
        }

        return $values;
    }
}