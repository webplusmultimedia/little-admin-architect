<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait ValidateValuesForRules
{
    public function getValidatedValues(array $values, null|array $datas = NULL, Model|null $model = NULL): array
    {
        if ($this->isDisabled()) {
            $model->{$this->name} = $model->getOriginal($this->name);
        } else {
            $values[$this->name] = $model->{$this->name};
        }
        return  $values;
    }
}
