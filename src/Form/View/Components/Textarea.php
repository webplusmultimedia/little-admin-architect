<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasAddon;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValue;

class Textarea extends AbstractComponent
{
    use CanBeWired;
    use HasAddon;

    // use HasFloatingLabel;
    use HasId;
    use HasName;
    use HasValidation;
    use HasValue;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
		\Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Textarea $field,
		public string                                                           $name = '',
		public string|null                                                      $caption = null,
		public array                                                            $locales = [null],
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.textarea';
    }

    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->name = $field->getName();
    }
}
