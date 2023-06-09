<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasAction;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanHaveUrl;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanNotify;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasButton;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\InteractWithLivewire;

abstract class Action extends BaseAction
{
    use CanHaveUrl;
    use CanNotify;
    use HasAction;
    use HasButton;
    use InteractWithLivewire;
}
