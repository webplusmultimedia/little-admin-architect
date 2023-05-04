<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasAddon;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasFloatingLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasPlaceholder;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasValidation;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits\HasValue;

class Input extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasFloatingLabel;
    use HasValue;
    use HasPlaceholder;
    use HasAddon;
    use HasValidation;
    use CanBeWired;

    protected string|null $id = null;

    public ?string $type = 'text';

    protected array|object|null $bind = null;

    protected string|false|null $label = null;

    protected bool|null $floatingLabel = null;

    protected string|false|null $placeholder = null;

    protected string|Closure|null $prepend = null;

    protected string|Closure|null $append = null;

    protected string|int|array|Closure|null $value = null;

    public string|null $caption = null;

    protected bool|null $displayValidationSuccess = null;

    protected bool|null $displayValidationFailure = true;

    protected string|null $errorBag = null;

    public array $locales = [null];

    public bool $marginBottom = true;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input $field,
    ) {
        parent::__construct();
        $this->field = $field;
        $this->type = $this->field->getType();
    }

    protected function setViewPath(): string
    {
        return 'input';
    }
}
