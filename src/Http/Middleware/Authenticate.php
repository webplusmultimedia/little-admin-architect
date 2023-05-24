<?php

namespace Webplusmultimedia\LittleAdminArchitect\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as AuthenticateAlias;
use Illuminate\Http\Request;
use Webplusmultimedia\LittleAdminArchitect\Http\Models\Contracts\LittleAdminUser;

class Authenticate extends AuthenticateAlias
{
    protected function authenticate($request, array $guards)
    {
        $guardName = config('little-admin-architect.auth.guard');
        $guard = $this->auth->guard($guardName);
        if (!$guard->check()){
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse($guardName);
        $user = $guard->user();
        if ($user instanceof LittleAdminUser) {
            abort_if(! $user->canAccessAdmin(), 403);

            return;
        }

        abort_if(config('app.env') !== 'local', 403);
    }

    protected function redirectTo(Request $request)
    {
        return route(config('little-admin-architect.route.prefix') .'.auth.login'); // TODO: Change the autogenerated stub
    }
}
