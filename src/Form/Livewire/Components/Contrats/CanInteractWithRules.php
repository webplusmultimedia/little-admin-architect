<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

use Illuminate\Database\Eloquent\Model;

interface CanInteractWithRules
{
    public function interactWithRules(array $rules, ?Model $model = null): array;
}
