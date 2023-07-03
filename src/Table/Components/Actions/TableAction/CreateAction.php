<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;

class CreateAction extends TableAction
{
    protected ?string $view = 'little-views::action.table-action';
    public function __construct()
    {
        $this->icon('heroicon-o-plus');
    }

    public static function make(): CreateAction
    {
        return new self();
    }

}
