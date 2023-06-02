<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Columns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\BadgeColumn;

class Badge extends Contracts\AbstractColumn
{
    protected string $viewPath = 'badge';

    public function __construct(protected BadgeColumn $column)
    {

    }

    public function getColumn(): BadgeColumn
    {
        return $this->column;
    }
}
