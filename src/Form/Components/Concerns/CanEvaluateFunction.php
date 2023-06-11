<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait CanEvaluateFunction
{
    public function evaluate(mixed $closure, string $name): mixed
    {
        if (is_callable($closure)) {
            /* $field = $this->getFormFieldByName($name);*/

            return app()->call($closure, [/*'livewire' => $this->livewire,*/ 'record' => $this->getRecord(), 'state' => $this->getState()]);
        }

        return $closure;
    }
}
