<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class CreateAction extends Contrats\FormAction
{
    protected ?string $view = 'little-views::action.table-action';
    public static function make(): CreateAction
    {
        return (new self())->icon('heroicon-o-plus');
    }

}
