<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

class AbstractPage
{
    protected static ?string $resource = null;

    public static function getResource(): ?string
    {
        return static::$resource;
    }

    public static function getComponentBaseName(): string
    {
        return  str(static::class)
            ->replace('\\','.')
            ->explode('.')
            ->map(fn($segment) => (string) str($segment)->kebab())
            ->implode('.');
    }
    public static function getComponent()
    {

    }
}
