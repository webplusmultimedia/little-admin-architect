<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

class TextColumn extends AbstractColumn
{
    protected string $view = 'text';
}
