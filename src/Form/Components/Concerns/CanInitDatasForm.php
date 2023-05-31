<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanInitDatasForm
{
    public function initDatasFormOnMount(null|array|Model $model): void
    {
        foreach ($this->fields as $field) {
            if ($field instanceof Field) {
                $field->record($model);
                Form::addFormField($field);

                continue;
            }
            $field->initDatasFormOnMount($model);
        }

    }
}
