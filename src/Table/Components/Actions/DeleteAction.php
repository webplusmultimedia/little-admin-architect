<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class DeleteAction extends Action
{
    public function __construct()
    {
        $this->label(trans('little-admin-architect::table.button.delete'))
            ->roundedFull()
            ->name(trans('little-admin-architect::table.button.delete'))
            ->action(fn (Model $record) => $record->delete())
            ->danger()
            ->requireConfirmation()
            ->confirmQuestion(trans('little-admin-architect::form.confirm_dialog.question'))
            ->small()
            ->icon('heroicon-s-x-mark')
            ->outline();

    }

    public static function make(): DeleteAction
    {
        return new self();
    }
}
