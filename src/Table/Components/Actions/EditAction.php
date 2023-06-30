<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class EditAction extends Action implements Htmlable
{
    public function __construct()
    {
        $this->label(trans('little-admin-architect::table.button.edit'))
            ->name('edit')
            ->icon('heroicon-s-pencil');
    }

    public static function make(): EditAction
    {
        return new self();
    }

    public function render(): View
    {
        return view('little-views::action.table-row-action', ['action' => $this]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
