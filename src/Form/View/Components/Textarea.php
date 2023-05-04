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

class Textarea extends AbstractComponent
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

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Textarea $field,
        public string|null $caption = null,
        public array $locales = [null],

    ) {
        parent::__construct();
       $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'textarea';
    }

    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->isRequiredField = $field->isRequired();
        $this->placeholder = $field->getPlaceHolder();
    }
}
