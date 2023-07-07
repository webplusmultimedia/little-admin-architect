<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action as ActionAlias;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

class FormAction extends ActionAlias
{
    protected ?FormDialog $formDialog = null;

    public function schemas(array $fields): void
    {

    }
}
