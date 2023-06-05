<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Notification;

trait HasNotification
{
    protected Notification $notification;

    public function notification(): Notification
    {
        return Notification::make($this);
    }
}
