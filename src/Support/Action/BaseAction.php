<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasColor;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasIcon;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasRecord;

abstract class BaseAction implements Htmlable
{
    use CanBeDisabled;
    use HasColor;
    use HasIcon;
    use HasLabel;
    use HasName;
    use HasRecord;

    protected ?string $view = null;

    protected function getView(): string
    {
        if ( ! isset($this->view)) {
            throw new Exception('Class [' . static::class . '] extends [' . static::class . '] but does not have a [$view] property defined.');
        }

        return $this->view;
    }

    public function render(): View
    {
        return view($this->getView(), ['action' => $this]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
