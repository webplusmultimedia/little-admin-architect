<?php

namespace Webplusmultimedia\LittleAdminArchitect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Webplusmultimedia\LittleAdminArchitect\LittleAdminArchitect
 */
class LittleAdminArchitect extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webplusmultimedia\LittleAdminArchitect\LittleAdminArchitect::class;
    }
}
