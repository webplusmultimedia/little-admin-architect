<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

trait CanEvaluateParameters
{
    protected array $defaultParameters = [];

    /** @param  array<int,string>  $excludes , can be 'set', 'get', 'state' or 'status' for field  */
    public function evaluate(mixed $closure, array $excludes = [], array $include = []): mixed
    {
        if (is_callable($closure)) {
            return app()->call(
                $closure,
                array_merge($this->getParameters($excludes), $include)
            );
        }

        return $closure;
    }

    protected function getParameters(array $excludes): array
    {
        return collect($this->getDefaultParameters())->filter(fn (mixed $value, string $key) => ! in_array($key, $excludes))->all();
    }

    protected function getDefaultParameters(): array
    {
        return $this->defaultParameters;
    }
}
