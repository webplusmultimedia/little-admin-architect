<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

trait CanInitDatasForm
{
    public function initDatasFormOnMount(null|array|Model $model): static
    {
        foreach ($this->fields as $field) {
            if ($field instanceof Field) {
                $field->record($model);
                Form::addFormField($field);

                continue;
            }
            $field->initDatasFormOnMount($model);
        }

        return $this;
    }
}
