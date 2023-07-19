<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\BaseAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Concerns\HasUrl;

abstract class TableAction extends BaseAction
{
    use HasUrl;
    use InteractWithLivewire;
}
