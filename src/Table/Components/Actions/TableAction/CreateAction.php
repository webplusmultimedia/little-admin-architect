<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;

class CreateAction extends TableAction
{
    protected ?string $view = 'little-views::action.table-action';

    public function authorize(): bool
    {
        if ($this->livewire && $this->livewire instanceof BaseTable) {
            return $this->livewire->table->getResourcePage()::canCreate();
        }

        return true;
    }

    public function __construct()
    {
        $this->icon('heroicon-o-plus');
    }

    public static function make(): CreateAction
    {
        return new self();
    }
}
