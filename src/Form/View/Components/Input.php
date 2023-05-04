<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
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

    protected string|null $id = NULL;
    public ?string $type = 'text';
    protected array|object|null $bind = NULL;
    protected string|false|null $label = NULL;
    protected bool|null $floatingLabel = NULL;
    protected string|false|null $placeholder = NULL;
    protected string|Closure|null $prepend = NULL;
    protected string|Closure|null $append = NULL;
    protected string|int|array|Closure|null $value = NULL;
    public string|null $caption = NULL;
    protected bool|null $displayValidationSuccess = NULL;
    protected bool|null $displayValidationFailure = true;
    protected string|null $errorBag = NULL;
    public array $locales = [NULL];
    public bool $marginBottom = true;



    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input $field ,
    )
    {
        parent::__construct();
        $this->field = $field;
        $this->type = $this->field->getType();
    }
    protected function setViewPath(): string
    {
        return 'input';
    }
}
