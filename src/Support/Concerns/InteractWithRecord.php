<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Illuminate\Database\Eloquent\Model;

trait InteractWithRecord
{
    protected Model $record;

    public function fill(mixed $key = null): Model
    {
        $resource = $this->getResourcePage();
        $model = $resource::getEloquentQuery()->getModel();
        if ($key) {
            $model = $resource::getEloquentQuery()->where($model->getKeyName(), $key)->firstOrFail();
            $this->model($model);

            return $model;
        }
        $this->model($model);
        $this->applyDefaultValue();

        return $model;
    }
}
