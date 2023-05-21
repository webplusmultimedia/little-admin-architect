<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;

class ListRecord extends Page
{
    protected static ?string $routeName = 'list';

    public function mount(): void
    {

        /*$this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();*/
    }

    protected static function setUpPage(): array
    {
        return [
            'component' => static::getComponent(),
            'pageRoute' => static::getComponent(),
            'id' => Str::random(10),
        ];
    }

    protected static function setUpLayout(): array
    {
        return [
            'title' => static::getResource()::getPluralModelLabel(),
        ];
    }

    public function render(): View
    {
        return view('little-views::livewire.list', static::setUpPage())
            ->layout('little-views::admin-components.Layouts.index', static::setUpLayout());
    }
}
