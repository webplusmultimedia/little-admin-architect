<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasAddon;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasFloatingLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasOptions;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasPlaceholder;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits\HasValidation;

class Select extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasFloatingLabel;
    use HasPlaceholder;
    use HasAddon;
    use HasOptions;
    use HasValidation;
    use CanBeWired;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        public array $options,
        protected string|null $id = null,
        protected array|object|null $bind = null,
        protected string|false|null $label = null,
        protected bool|null $floatingLabel = null,
        protected string|false|null $placeholder = null,
        public bool $allowPlaceholderToBeSelected = false,
        protected string|Closure|null $prepend = null,
        protected string|Closure|null $append = null,
        protected int|string|array|null $selected = null,
        public string|null $caption = null,
        protected bool|null $displayValidationSuccess = null,
        protected bool|null $displayValidationFailure = null,
        protected string|null $errorBag = null,
        public bool $marginBottom = true
    ) {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'select';
    }
}
