<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns\CanRequireConfirmation;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\Action;

abstract class BaseRowAction extends Action
{
    use CanRequireConfirmation;

    protected bool $inGroupAction = false;

    public function inGroupAction(): void
    {
        $this->inGroupAction = true;
    }

    public function isInGroupAction(): bool
    {
        return $this->inGroupAction;
    }
}
