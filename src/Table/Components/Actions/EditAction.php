<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\BaseRowAction;

class EditAction extends BaseRowAction
{
    protected ?string $view = 'little-views::action.table-row-action';

    public function __construct()
    {
        if ( ! $this->hasLabel()) {
            $this->label(trans('little-admin-architect::table.button.edit'));
        }
        $this->name('edit')
            ->icon('heroicon-s-pencil')
            ->requireConfirmation(false);
    }

    public function authorize(): bool
    {
        if ($this->livewire && $this->livewire instanceof BaseTable) {
            return $this->livewire->table->getResourcePage()::canEdit($this->record);
        }

        return true;
    }

    public static function make(): EditAction
    {
        return new self();
    }
}
