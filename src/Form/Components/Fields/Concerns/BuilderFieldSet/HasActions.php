<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet;



use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

trait HasActions
{
    protected array $actions = [];

    protected function getActions()
    {
        return [
            'add' => Action::make()->icon('heroicone')
        ];
    }
}
