<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Http\Models\Contracts;

interface LittleAdminUser
{
    public function canAccessAdmin(): bool;
}
