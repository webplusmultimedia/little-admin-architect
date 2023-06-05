<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait CanBeCancel
{
    protected bool $canCancelConfirmation = false;

    public function canCancel(): void
    {

    }
}
