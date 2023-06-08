<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components;

use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns\HasContent;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns\HasTitle;

abstract class BaseModal extends Component
{
    use HasContent;
    use HasTitle;
}
