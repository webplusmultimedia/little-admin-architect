<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

interface HasInitialSetUp
{
    public function setUp(Field $field): void;
}
