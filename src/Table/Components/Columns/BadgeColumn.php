<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasColors;

class BadgeColumn extends contracts\AbstractColumn
{
    use HasColors;

    protected string $view = 'badge';
}
