<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CanValidateValuesForRules
{
    public function getValidatedValues(array $values, array $datas = null, Model $model = null): array;
}
