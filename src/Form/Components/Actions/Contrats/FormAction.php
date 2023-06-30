<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\BaseAction;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Concerns\HasUrl;

abstract class FormAction extends BaseAction
{
    use HasUrl;
    use InteractWithLivewire;
}
