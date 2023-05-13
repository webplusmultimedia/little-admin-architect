<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasDefaultValue
{
    protected mixed $defaultValue = null;
    public function applyDefaultValue(?Model $model): void
    {
        if ($this->defaultValue and $model){
            $model->{$this->name} = $this->defaultValue;
        }
    }
    public function default(mixed $value): static
    {
        $this->defaultValue = $value;
        return $this;
    }

}
