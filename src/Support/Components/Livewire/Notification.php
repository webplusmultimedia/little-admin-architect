<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Notification extends Component
{
    protected array $typeMessage = [
        'success',
        'warning',
        'info',
        'danger',
    ];

    /*   protected $listeners = [
           'send-message-notification' => 'sendMessage',
       ];

       public function sendMessage(string $message, string $type = 'success'): array
       {
           return [
               'message' => $message,
               'type'    => $type,
           ];
       }*/

    public function render(): View
    {
        return view('little-views::notification.notification');
    }
}
