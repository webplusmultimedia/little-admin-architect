<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Illuminate\Support\Str;

trait HasStatePath
{
    protected string $prefixPath = 'tableFilters';

    protected ?string $filterPath = null;

    protected function getFilterPath(): string
    {
        $path = str($this->name);
        if ( ! blank($this->getLabel())) {

            $path = $path->append('.' . Str::slug($this->getLabel(), '_'));
        }

        return $path->value();
    }
}
