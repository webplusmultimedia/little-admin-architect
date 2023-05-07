<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

use Illuminate\Database\Eloquent\Model;

interface CanValidateValuesForRules
{
    public function getValidatedValues(array $values, null|array $datas = null, Model|null $model = null): array;
}
