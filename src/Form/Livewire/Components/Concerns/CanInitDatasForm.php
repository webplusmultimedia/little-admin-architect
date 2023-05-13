<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanInitDatasForm
{
    public function initDatasFormOnMount(?Model $model): void
    {
        foreach ($this->fields as $field) {
            $field->initDatasFormOnMount($model);
        }
    }
}
