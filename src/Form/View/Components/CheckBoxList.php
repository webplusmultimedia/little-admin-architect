<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class CheckBoxList extends AbstractComponent
{
    use HasId;
    use HasName;
    use HasValidation;

    public function __construct(
        \Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBoxList $field,
        public null|string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.check-box-list';
    }

    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->name = $field->getName();
    }
}
