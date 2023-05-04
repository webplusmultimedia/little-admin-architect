<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\CanBeChecked;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasValidation;

class Checkbox extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasValidation;
    use CanBeChecked;
    use CanBeWired;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        public array $group = [null],
        protected string|null $id = null,
        protected array|object|null $bind = null,
        protected string|false|null $label = null,
        protected bool|array|null $checked = null,
        public string|null $caption = null,
        protected bool|null $displayValidationSuccess = null,
        protected bool|null $displayValidationFailure = null,
        protected string|null $errorBag = null,
        public bool $marginBottom = true,
        public bool $inline = false,
        public bool $toggleSwitch = false,

    ) {
        $this->displayValidationSuccess = $this->shouldDisplayValidationSuccess();
        $this->displayValidationFailure = $this->shouldDisplayValidationFailure();
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'checkbox';
    }
}
