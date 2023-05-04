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
    use HasValue;
    use HasPlaceholder;
    use HasAddon;
    use HasValidation;
    use CanBeWired;


    public ?string $type = 'text';

    public string|null $caption = null;
    public array $locales = [null];

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input $field,
    ) {
        parent::__construct();
        $this->setUp($field);
    }
    protected function setViewPath(): string
    {
        return 'input';
    }
    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->type = $field->getType();
        $this->placeholder = $field->getPlaceHolder();
        $this->isRequiredField = $field->isRequired();
    }
}
