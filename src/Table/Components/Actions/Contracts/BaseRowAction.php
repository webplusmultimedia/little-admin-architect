<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanRequireConfirmation;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\Action;

abstract class BaseRowAction extends Action
{
    use CanRequireConfirmation;
}
