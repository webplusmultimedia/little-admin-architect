<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait CanNotify
{
    protected ?string $eventNotification = null;

    protected ?string $notificationText = null;

    protected ?string $eventTarget = null;

    public function eventNotification(string $event): static
    {
        $this->eventNotification = $event;

        return $this;
    }

    public function eventTarget(string $target): static
    {
        $this->eventTarget = $target;

        return $this;
    }

    public function getAlpineDispatch(): ?string
    {
        if ($this->eventNotification) {
            return "@click.stop=\"\$dispatch('{$this->eventNotification}')\"";
        }

        return null;
    }

    public function notificationText(?string $notificationText): static
    {
        $this->notificationText = $notificationText;

        return $this;
    }

    public function getNotificationText(): string
    {
        if ( ! $this->notificationText) {
            $this->notificationText = trans('little-admin-architect::action.notification');
        }

        return $this->notificationText;
    }
}
