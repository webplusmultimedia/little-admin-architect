<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns\HasContent;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns\HasTitle;

abstract class BaseModal extends Component implements Htmlable
{
    protected string $view = 'little-views::modal.modal';

    use HasContent;
    use HasTitle;

    public ?string $formAction = null;

    public ?string $alpineData = null;

    public ?string $actionData = null;

    public ?string $alpineCloseModal = null;

    public function render(): View
    {
        return view(
            $this->view,
            $this->data()
        );
    }
}
