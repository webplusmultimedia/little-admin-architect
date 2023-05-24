<?php

namespace Webplusmultimedia\LittleAdminArchitect\Facades;

use Illuminate\Support\Facades\Facade;

class LittleAdminManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'little-admin-manager';
    }
}
