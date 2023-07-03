<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts\BaseRowAction;

class RowAction extends BaseRowAction
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
