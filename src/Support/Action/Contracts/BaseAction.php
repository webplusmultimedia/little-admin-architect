<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts;

use Exception;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanAuthorizeAccess;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasCssClass;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasIcon;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns\HasRecord;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\CanEvaluateParameters;

abstract class BaseAction implements Htmlable
{
    use CanAuthorizeAccess;
    use CanBeDisabled;
    use CanEvaluateParameters;
    use HasCssClass;
    use HasIcon;
    use HasLabel;
    use HasName;
    use HasRecord;

    protected ?string $view = null;

    protected BaseTable|BaseForm|Page|null $livewire = null;

    public function livewire(BaseTable|BaseForm|Page $livewire): void
    {
        $this->livewire = $livewire;
    }

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
