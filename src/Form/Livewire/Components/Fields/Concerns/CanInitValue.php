<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanInitValue
{
    public function initDatasFormOnMount(?Model $model): void
    {

    }
}
