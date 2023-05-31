<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasType;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class Checkbox extends AbstractComponent
{
    // use CanBeChecked;
    use CanBeWired;
    use HasId;
    use HasName;
    use HasType;
    use HasValidation;

    public array $group = [null];

    protected array|object|null $bind = null;

    protected bool $checked = false;

    public string|null $caption = null;

    public bool $inline = false;

    public bool $toggleSwitch = false;

    public function getBind(): object|array|null
    {
        return $this->bind;
    }

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
		\Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox $field,
		public null|string                                                      $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.checkbox';
    }

    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->name = $field->getName();
    }
}
