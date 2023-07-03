<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class EditAction extends Action
{
    protected ?string $view = 'little-views::action.table-row-action';
    public function __construct()
    {
        if (!$this->hasLabel()) {
            $this->label(trans('little-admin-architect::table.button.edit'));
        }
        $this->name('edit')
            ->icon('heroicon-s-pencil');
    }

    public static function make(): EditAction
    {
        return new self();
    }


}
