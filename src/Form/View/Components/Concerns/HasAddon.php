<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

use Closure;

trait HasAddon
{
    protected string|Closure|null $prepend = null;

    protected string|Closure|null $append = null;

    public function getPrepend(string $locale = null): string|null
    {
        if ($this->prepend instanceof Closure) {
            return ($this->prepend)($locale ?: app()->getLocale());
        }

        return $this->prepend;
    }

    public function getAppend(string $locale = null): string|null
    {
        if ($this->append instanceof Closure) {
            return ($this->append)($locale ?: app()->getLocale());
        }

        return $this->append;
    }
}
