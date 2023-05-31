<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

interface HasInitialSetUp
{
    public function setUp(Field $field): void;
}
