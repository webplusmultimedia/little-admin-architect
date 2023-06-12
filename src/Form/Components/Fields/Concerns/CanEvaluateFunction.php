<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait CanEvaluateFunction
{
    public function evaluate(mixed $closure): mixed
    {
        if (is_callable($closure)) {
            return app()->call($closure, ['livewire' => $this->livewire, 'record' => $this->getRecord(), 'state' => $this->getState(), 'status' => $this->getStatusForm()]);
        }

        return $closure;
    }
}
