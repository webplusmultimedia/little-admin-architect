<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Columns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn;
use Webplusmultimedia\LittleAdminArchitect\Table\Views\Columns\Contracts\AbstractColumn;

class Text extends AbstractColumn
{
    protected string $viewPath = 'text';

    public function __construct(
        protected TextColumn $column,
    ) {
    }

    public function getColumn(): TextColumn
    {
        return $this->column;
    }
}
