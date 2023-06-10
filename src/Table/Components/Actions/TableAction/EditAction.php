<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;

class EditAction extends TableAction
{
    public static function make(): EditAction
    {
        return new self();
    }
}
