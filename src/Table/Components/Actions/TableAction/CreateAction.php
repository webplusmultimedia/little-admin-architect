<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;

class CreateAction extends TableAction
{
    public function __construct()
    {

    }

    public static function make(): CreateAction
    {
        return new self();
    }
}
