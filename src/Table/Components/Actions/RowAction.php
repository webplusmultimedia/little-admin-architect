<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action;

class RowAction extends Action
{
    public function __construct(
        protected ?string $name
    )
    {

    }

    public static function make(string $name): RowAction
    {
        return new self($name);
    }
}
