<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\BaseAction;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Concerns\HasUrl;

abstract class FormAction extends BaseAction
{
    use HasUrl;
    use InteractWithLivewire;
}
