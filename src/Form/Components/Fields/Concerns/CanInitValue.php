<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanInitValue
{
    public function initDatasFormOnMount(?Model $model): void
    {

    }

    public function getValue(): mixed
    {
        return $this->getRecord()->{$this->getName()};
    }
}
