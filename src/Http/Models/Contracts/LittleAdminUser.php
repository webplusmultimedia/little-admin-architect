<?php

namespace Webplusmultimedia\LittleAdminArchitect\Http\Models\Contracts;

interface LittleAdminUser
{
    public function canAccessAdmin(): bool;
}
