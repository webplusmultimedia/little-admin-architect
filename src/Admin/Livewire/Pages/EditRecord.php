<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

class EditRecord extends Page
{
    protected static ?string $routeName = 'edit';

    public function mount($record): void
    {
        /** @var Resources $resource */
        $resource = static::getResource();
        static::$form = $resource::getFormSchema(Form::make($resource::getModelLabel()));
        $model = $resource::getEloquentQuery()->getModel();
        static::$record = $resource::getEloquentQuery()->where($model->getKeyName(), $record)->firstOrFail();
        /*$this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();*/
    }

    protected static function setUpPage(): array
    {
        return [
            'component' => static::getComponent(),
            'data' => static::$record,
            'pageRoute' => static::getComponent(),
            'id' => Str::random(10),
        ];
    }
}
