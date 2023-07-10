<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CanValidatedValues
{
    protected array $datasRelation = [];

    protected bool $hasDatasRelationshipForSave = false;

    public function values(array $datas): array
    {
        $values = [];
        if ($this->model instanceof Model) {
            foreach ($this->getFormFields() as $field) {
                $values = $field->getValidatedValues(values: $values, datas: $datas, model: $this->model);
                //Save datas for relationship for save after saving livewire data
                if ($field->hasRelationship() and BelongsToMany::class === $field->getRelationType()) {
                    $this->datasRelation[$field->getName()] = $field->getState();
                    $this->hasDatasRelationshipForSave = true;
                }
            }
        }

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
