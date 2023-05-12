<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Notifications;

use Livewire\Component;

class Notifications extends Component
{
    public ?string $message = null;
    public string $type = 'success'; // success, warning, info, error

}
