<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class EditAction extends Action
{
    protected string|null $icon = 'heroicon-s-pencil-square';

    public function __construct()
    {
        $this->label = trans('little-admin-architect::table.button.edit');
        $this->roundedFull() ;
        $this->outline();
    }

    public static function make(): static
    {
       return new static();
    }
}
