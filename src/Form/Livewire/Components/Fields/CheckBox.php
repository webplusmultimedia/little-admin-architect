<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeBoolean;

class CheckBox extends Field
{
    use CanBeBoolean;
    protected string $view = 'checkbox';

}
