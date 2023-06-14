<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait ValidateValuesForRules
{
    public function getValidatedValues(array $values, null|array $datas = null, Model $model = null): array
    {
        if ($this->isDisabled()) {
            if ($model) {
                $model->{$this->name} = $model->getOriginal($this->name);
            }
        } else {
            $values[$this->name] = $this->getState();
        }

        return $values;
    }
}
