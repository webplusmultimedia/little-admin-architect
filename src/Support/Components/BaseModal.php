<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns\HasContent;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns\HasTitle;

abstract class BaseModal extends Component implements Htmlable
{
    use HasContent;
    use HasTitle;

    public ?string $formAction = null;

    public ?string $alpineData = null;

    public ?string $actionData = null;
}
