<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class CreateRecord extends Page
{
    protected static ?string $routeName = 'create';
    public function mount(): void
    {

        /** @var Resources $resource */
        $resource = static::getResource();
        static::$form  =  $resource::getForm();

        static::$record = new ($resource::getModel());
        //static::$form->bind(static::$record);

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
