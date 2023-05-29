<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Contracts;

interface HasTable
{
    public function sortable(string $column);
}
