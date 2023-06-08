<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class EditAction extends Action
{
    public function __construct()
    {
        $this->label(trans('little-admin-architect::table.button.edit'))
            ->roundedFull()
            ->small()
            ->name('edit')
            ->icon('heroicon-s-pencil')
            ->outline();
    }

    public static function make(): EditAction
    {
        return new self();
    }
}
