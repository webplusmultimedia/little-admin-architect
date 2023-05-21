<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasPlaceholder;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class Select extends AbstractComponent
{
    use HasId;
    use HasLabel;
    use HasName;
    use HasPlaceholder;
    use HasValidation;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select $field,
        public null|string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.select';
    }

    protected function setUp(AbstractLayout|Field $field): void
    {
        $this->field = $field;
        $this->placeholder = $field->getPlaceHolder();
        $this->isRequiredField = $field->isRequired();
        $this->name = $field->getName();
    }
}
