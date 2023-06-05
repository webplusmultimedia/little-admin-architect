<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasColor;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasIcon;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasLabel;

abstract class BaseAction
{
    use CanBeDisabled;
    use HasColor;
    use HasIcon;
    use HasLabel;
}
