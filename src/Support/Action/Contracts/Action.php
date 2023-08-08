<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasAction;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\CanHaveUrl;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\CanNotify;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\CanSizeModal;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\HasButton;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\InteractWithAlpineData;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\InteractWithLivewire;

abstract class Action extends BaseAction
{
    use CanHaveUrl;
    use CanNotify;
    use CanSizeModal;
    use HasAction;
    use HasButton;
    use InteractWithAlpineData;
    use InteractWithLivewire;
}
