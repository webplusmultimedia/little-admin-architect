<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanValidatedValues
{
    public function values(array $datas): array
    {
        $values = [];
        if ($this->model instanceof Model) {
            foreach ($this->getFormFields() as $field) {
                $values = $field->getValidatedValues(values: $values, datas: $datas, model: $this->model);
            }
        }
        /*if (is_array($this->model)){
            foreach ($this->getFormFields() as $field) {

            }
        }*/

        return $values;
    }

    protected function restoreValueAfterSavedUsing(): void
    {
        if ($this->model instanceof Model) {
            foreach ($this->getFormFields() as $field) {
                $field->afterSavedUsing();
            }
        }
    }
}
