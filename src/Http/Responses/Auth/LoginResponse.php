<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth;

use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;
use Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth\Contracts\LoginResponse as Responsable;
use Webplusmultimedia\LittleAdminArchitect\LittleAdminManager;

class LoginResponse implements Responsable
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        return redirect()->intended((new LittleAdminManager())->getUrl());
    }
}
