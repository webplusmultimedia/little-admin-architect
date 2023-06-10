<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\views;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableAction extends Component
{
    public function __construct(public \Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction $action)
    {

    }

    public function render(): View
    {
        return $this->view('little-views::action.table-action');
    }
}
