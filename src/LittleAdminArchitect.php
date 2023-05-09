<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

class LittleAdminArchitect
{
    public function getMe(): string
    {
        return 'me';
    }

    public function getResourceManager():LittleAminManager
    {
        return app('little-admin-manager');
    }
}
