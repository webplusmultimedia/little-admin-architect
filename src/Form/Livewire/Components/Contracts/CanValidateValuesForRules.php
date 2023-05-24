<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CanValidateValuesForRules
{
    public function getValidatedValues(array $values, null|array $datas = null, Model|null $model = null): array;
}
