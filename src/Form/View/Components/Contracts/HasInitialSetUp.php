<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

interface HasInitialSetUp
{
    function setUp(Field $field): void;
}
