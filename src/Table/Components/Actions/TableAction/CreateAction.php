<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\TableAction;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\TableAction;

class CreateAction extends TableAction implements Htmlable
{
    public function __construct()
    {

    }

    public static function make(): CreateAction
    {
        return new self();
    }

    public function render(): View
    {
        return view('little-views::action.table-action', ['action' => $this]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
