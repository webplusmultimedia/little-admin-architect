<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanInitDatasForm
{
    public function initDatasFormOnMount(null|array|Model $model, BaseForm $livewire): void
    {
        foreach ($this->fields as $field) {
            if ($field instanceof Field) {
                $field->record($model);
                $field->livewire($livewire);
                $field->hydrateState();
                $field->statusForm($this->statusForm ?? $this->getStatusForm());
                Form::addFormField($field);

                continue;
            }

            $field->setStatusForm($this->statusForm);

            $field->initDatasFormOnMount($model, $livewire);
        }

    }
}
