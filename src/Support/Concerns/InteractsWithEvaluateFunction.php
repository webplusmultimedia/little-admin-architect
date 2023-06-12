<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Closure;

trait InteractsWithEvaluateFunction
{
    protected function set(): Closure
    {
        return function (string $name, mixed $value): void {
            $this->record->{$name} = $value;
        };
    }

    protected function get(): Closure
    {
        return function (string $name) {
            return $this->record->{$name};
        };
    }
}
