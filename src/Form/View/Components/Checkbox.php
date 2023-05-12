<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\CanBeChecked;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasType;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class Checkbox extends AbstractComponent
{
    use CanBeChecked;
    use CanBeWired;
    use HasId;
    use HasLabel;
    use HasName;
    use HasType;
    use HasValidation;

    public array $group = [null];

    protected array|object|null $bind = null;

    protected bool|array|null $checked = null;

    public string|null $caption = null;

    public bool $inline = false;

    public bool $toggleSwitch = false;

    public function getBind()
    {
        return $this->bind;
    }

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        Field $field,
        public null|string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.checkbox';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        $this->field = $field;
        $this->name = $field->getName();
    }
}
