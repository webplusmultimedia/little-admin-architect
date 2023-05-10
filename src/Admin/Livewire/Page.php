<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Livewire\Component;

class Page extends Component
{
    protected static ?string $resource = null;

    public static function getResource(): ?string
    {
        return static::$resource;
    }

    public static function getComponent()
    {
        return  str(static::class)
            ->replace('\\','.')
            ->explode('.')
            ->map(fn($segment) => (string) str($segment)->kebab())
            ->implode('.');
    }

    public static function setUp(): array
    {
        return[
            'component' => static::getComponent()
        ];
    }
    public function render()
    {
        return view('little-views::livewire.page',static::setUp())
            ->layout('little-views::admin-components.Layouts.index');
    }
}
