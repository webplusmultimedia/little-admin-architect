<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class RowAction extends Action
{
    protected ?string $view = 'little-views::action.table-row-action';
    public function __construct(
        protected ?string $name
    ) {

    }

    public static function make(string $name): RowAction
    {
        return new self($name);
    }
}
