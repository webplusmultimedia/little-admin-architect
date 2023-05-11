<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class EditRecord extends Page
{
    protected static ?string $routeName = 'edit';
    public function mount($record): void
    {
        /** @var Resources $resource */
        $resource = static::getResource();
        static::$form  =  $resource::getForm();
        static::$record = $resource::getEloquentQuery()->whereId($record)->firstOrFail();
        /*$this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();*/
    }

    protected static function setUpForm(): array
    {
        return[
            'component' => static::getComponent(),
            'data' => static::$record,
            'config' => static::class,
            'id' => Str::random(10)
        ];
    }
}
