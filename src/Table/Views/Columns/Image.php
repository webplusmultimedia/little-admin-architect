<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Columns;

use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\ImageColumn;

class Image extends Contracts\AbstractColumn
{
    protected string $viewPath = 'image';

    public function __construct(protected ImageColumn $column)
    {

    }

    public function getColumn(): ImageColumn
    {
        return $this->column;
    }
}
