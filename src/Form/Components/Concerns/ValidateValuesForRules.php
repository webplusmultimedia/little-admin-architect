<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait ValidateValuesForRules
{
    protected ?Closure $afterUpdatedValidateValueUsing = null;

    protected ?Closure $beforeUpdatedValidateValueUsing = null;

    protected ?Closure $afterCreatedValidateValueUsing = null;

    protected ?Closure $beforeCreatedValidateValueUsing = null;

    public function getValidatedValues(array $values, null|array $datas = null, Model $model = null): array
    {
        /* Can do some stuff before datas is saving | return false to deny value from saving */
        if ( ! $this->beforeValidateValueUsing()) {
            return $values;
        }
        /* Restore datas if field is disable before saving datas */
        if ($this->isDisabled()) {
            if ($model) {
                /* Restore datas if field is disable before saving datas */
                $model->{$this->name} = $model->getOriginal($this->name);
            }
        } else {
            /* set value if field is disable before saving datas */
            $values[$this->name] = $this->getState();
        }

        return $values;
    }

    protected function beforeValidateValueUsing(): bool
    {
        if (Form::UPDATED === $this->statusForm and $this->beforeUpdatedValidateValueUsing) {
            return $this->evaluate($this->beforeUpdatedValidateValueUsing);
        }
        if (Form::CREATED === $this->statusForm and $this->beforeCreatedValidateValueUsing) {
            return $this->evaluate($this->beforeCreatedValidateValueUsing);
        }

        return true;
    }

    public function afterSavedUsing(): void
    {
        if (Form::UPDATED === $this->statusForm and $this->afterUpdatedValidateValueUsing) {
            $this->evaluate($this->afterUpdatedValidateValueUsing);
        }
        if (Form::CREATED === $this->statusForm and $this->afterCreatedValidateValueUsing) {
            $this->evaluate($this->afterCreatedValidateValueUsing);
        }
    }

    public function setAfterUpdatedValidateValueUsing(Closure $afterUpdatedValidateValueUsing): void
    {
        $this->afterUpdatedValidateValueUsing = $afterUpdatedValidateValueUsing;
    }

    public function setBeforeUpdatedValidateValueUsing(Closure $beforeUpdatedValidateValueUsing): void
    {
        $this->beforeUpdatedValidateValueUsing = $beforeUpdatedValidateValueUsing;
    }

    public function setAfterCreatedValidateValueUsing(Closure $afterCreatedValidateValueUsing): void
    {
        $this->afterCreatedValidateValueUsing = $afterCreatedValidateValueUsing;
    }

    public function setBeforeCreatedValidateValueUsing(Closure $beforeCreatedValidateValueUsing): void
    {
        $this->beforeCreatedValidateValueUsing = $beforeCreatedValidateValueUsing;
    }
}
