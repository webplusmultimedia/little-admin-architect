<?php

namespace Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth;

use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;
use Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth\Contracts\LoginResponse as Responsable;
use Webplusmultimedia\LittleAdminArchitect\LittleAminManager;

class LoginResponse implements Responsable
{

    public function toResponse($request): RedirectResponse|Redirector
    {
        return redirect()->intended((new LittleAminManager)->getUrl());
    }
}
