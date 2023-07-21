<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

class CreateAction extends Contrats\FormAction
{
    protected ?string $view = 'little-views::action.table-action';

    public static function make(): CreateAction
    {
        return (new self())
            ->mediumIconSize()
            ->icon('heroicon-o-plus');
    }
}
