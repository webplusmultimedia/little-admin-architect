<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class Page extends Component
{
    protected static ?string $resource = null;
    protected static ?Model $record = null;
    protected static \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form $form;
    protected static ?string $route = null;
    protected static ?string $routeName = NULL;

    public static function getResource(): null|string|Resources
    {
        return static::$resource;
    }

    protected static function title(): string
    {
        return (static::getResource())::getModelLabel();
    }

    public static function getForm(): \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form
    {
        return static::$form;
    }
    public static function route(string $path): array
    {
        return [
            'class' => static::class,
            'route' => $path,
        ];
    }
    public static function getComponent()
    {
        return  str(static::class)
            ->replace('\\','.')
            ->explode('.')
            ->map(fn($segment) => (string) str($segment)->kebab())
            ->implode('.');
    }

    protected static function setUpForm(): array
    {
        return[

        ];
    }

    public function render()
    {
        return view('little-views::livewire.page',static::setUpForm())
            ->layout('little-views::admin-components.Layouts.index');
    }
}
