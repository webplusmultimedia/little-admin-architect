<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

class EditRecord extends Page
{
    protected static mixed $key = null;

    protected static ?string $routeName = 'edit';

    public function mount(mixed $record): void
    {
        /** @var Resources\Resource $resource */
        $resource = static::getResource();
        static::$form = $resource::getFormSchema(Form::make($resource::getModelLabel()));
        static::$key = $record;
        /* $model = $resource::getEloquentQuery()->getModel();
         static::$record = $resource::getEloquentQuery()->where($model->getKeyName(), $record)->firstOrFail();*/
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
