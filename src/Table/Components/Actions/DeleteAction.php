<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\BaseRowAction;

class DeleteAction extends BaseRowAction
{
    protected ?string $view = 'little-views::action.table-row-action';

    public function __construct()
    {
        if ( ! $this->hasLabel()) {
            $this->label(trans('little-admin-architect::table.button.delete'));
        }
        $this->name(trans('little-admin-architect::table.button.delete'))
            ->notificationText(trans('little-admin-architect::table.notification.delete'))
            ->action(fn (Model $record) => $record->delete())
            ->danger()
            ->requireConfirmation()
            ->confirmQuestion(trans('little-admin-architect::form.confirm_dialog.question'))
            ->icon('heroicon-s-trash');
    }

    public function authorize(): bool
    {
        if ($this->livewire && $this->livewire instanceof BaseTable and $this->record instanceof Model) {
            return $this->livewire->table->getResourcePage()::canDelete($this->record);
        }

        return true;
    }

    public static function make(): DeleteAction
    {
        return new self();
    }
}
