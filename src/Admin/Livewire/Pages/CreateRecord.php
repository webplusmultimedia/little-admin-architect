<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources;

class CreateRecord extends Page
{
    protected static ?string $routeName = 'create';

    protected static mixed $key = null;

    public function mount(): void
    {

        /** @var Resources\Resource $resource */
        $resource = static::getResource();
        /*static::$form = $resource::getFormSchema(Form::make($resource::getModelLabel()));

        static::$record = new ($resource::getModel());*/
        //static::$form->bind(static::$record);

        /*$this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();*/
    }

    public function getDataView(): array
    {
        return [
            'component' => static::getComponent(),
            'data' => static::$key,
            'pageRoute' => static::getComponent(),
            'id' => Str::random(10),
        ];
    }
}
