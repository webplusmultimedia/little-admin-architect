<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

class AbstractPage
{
    protected static ?string $resource = null;

    public static function getResource(): ?string
    {
        return static::$resource;
    }

    public static function getComponentBaseName(): string
    {
        return str(static::class)
            ->replace('\\', '.')
            ->explode('.')
            ->map(fn ($segment) => (string) str($segment)->kebab())
            ->implode('.');
    }

    public static function getComponent(): void
    {

    }
}
