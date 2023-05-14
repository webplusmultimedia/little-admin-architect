<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasDefaultValue
{
    protected mixed $defaultValue = null;

    public function applyDefaultValue(?Model $model): void
    {
        if ($model and ! $model->exists) {
            foreach ($this->fields as $field) {
                $field->applyDefaultValue($model);
            }
        }
    }
}
