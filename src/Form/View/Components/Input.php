<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasAddon;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasPlaceholder;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class Input extends AbstractComponent
{
    use HasAddon;
    use HasId;
    use HasLabel;
    use HasName;

    //use HasValue;
    use HasPlaceholder;
    use HasValidation;
    // use CanBeWired;

    public ?string $type = 'text';

    public string|null $caption = null;

    public array $locales = [null];

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input $field,
        public null|string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.input';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        $this->field = $field;
        $this->type = $field->getType();
        $this->placeholder = $field->getPlaceHolder();
        $this->isRequiredField = $field->isRequired();
        $this->name = $field->getName();
    }
}
