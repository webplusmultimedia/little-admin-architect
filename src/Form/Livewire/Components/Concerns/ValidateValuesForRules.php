<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait ValidateValuesForRules
{
    public function getValidatedValues(array $values, null|array $datas = null, Model|null $model = null): array
    {
        if ($this->isDisabled()) {
            $model->{$this->name} = $model->getOriginal($this->name);
        } else {
            $values[$this->name] = $this->getDataRecord();
        }

        return $values;
    }


}
