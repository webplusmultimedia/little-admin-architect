<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class ListRecord extends Page
{
    protected static ?string $routeName = 'list';

    public function mount(): void
    {
        /** @var Resources $resource */
        //        $resource = static::getResource();
        //        static::$records = $resource::getEloquentQuery()->paginate(static::$rowsPerPage);
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

    public function render()
    {
        return view('little-views::livewire.list', static::setUpPage())
            ->layout('little-views::admin-components.Layouts.index', static::setUpLayout());
    }
}
