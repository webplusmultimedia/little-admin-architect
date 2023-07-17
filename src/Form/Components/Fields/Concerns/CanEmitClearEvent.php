<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait CanEmitClearEvent
{
    protected string $clearEventName = 'clear_event';

    public function getClearEventName(): ?string
    {
        return null;
    }

    public function emitClearEvent(mixed $value = null): void
    {
        if ($eventName = $this->getClearEventName()) {
            $this->livewire->emit($eventName, ['value' => $value]);
        }
    }
}
