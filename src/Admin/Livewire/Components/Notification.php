<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components;

use Livewire\Component;

class Notification
{
    protected string $message;

    protected string $type = 'success';

    public function __construct(protected readonly Component $livewire)
    {
    }

    public static function make(Component $livewire): Notification
    {
        return new self($livewire);
    }

    public function send(): void
    {
        $this->livewire->dispatchBrowserEvent('little-admin-send-notification', ['message' => $this->message, 'type' => $this->type]);
    }

    public function success(string $message): Notification
    {
        $this->message = $message;
        $this->type = 'success';

        return $this;
    }

    public function error(string $message): Notification
    {
        $this->message = $message;
        $this->type = 'danger';

        return $this;
    }

    public function warning(string $message): Notification
    {
        $this->message = $message;
        $this->type = 'warning';

        return $this;
    }

    public function info(string $message): Notification
    {
        $this->message = $message;
        $this->type = 'info';

        return $this;
    }
}
