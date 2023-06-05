<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanHaveUrl;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanNotify;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasButton;

abstract class Action extends BaseAction
{
    use CanHaveUrl;
    use CanNotify;
    use HasButton;
}
