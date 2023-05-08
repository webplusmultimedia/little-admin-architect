<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait InteractWithRules
{
    public function interactWithRules(array $rules, ?Model $model = null): array
    {
        $rules['data.'.$this->name] = $this->rules;

        return $rules;
    }
}
