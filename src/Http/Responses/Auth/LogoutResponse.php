<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth;

use Illuminate\Http\RedirectResponse;
use Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;

class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->to(
            config('little-admin-architect.auth.pages.login') ? route(config('little-admin-architect.route.prefix') . '.auth.login') : config('little-admin-architect.path'),
        );
    }
}
