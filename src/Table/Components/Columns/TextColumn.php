<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasDateTimeValue;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasMoneyValue;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\contracts\AbstractColumn;

class TextColumn extends AbstractColumn
{
    use HasDateTimeValue;
    use HasMoneyValue;
    protected string $view = 'text';
}
