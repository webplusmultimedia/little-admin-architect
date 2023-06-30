<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class DeleteAction extends Action implements Htmlable
{
    public function __construct()
    {
        $this->label(trans('little-admin-architect::table.button.delete'))
            ->name(trans('little-admin-architect::table.button.delete'))
            ->notificationText(trans('little-admin-architect::table.notification.delete'))
            ->action(fn (Model $record) => $record->delete())
            ->danger()
            ->requireConfirmation()
            ->confirmQuestion(trans('little-admin-architect::form.confirm_dialog.question'))
            ->icon('heroicon-s-x-mark');
    }

    public static function make(): DeleteAction
    {
        return new self();
    }

    public function render(): View
    {
        return view('little-views::action.table-row-action',['action'=>$this]);
    }
    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
