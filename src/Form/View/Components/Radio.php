<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent as AbstractComponentAlias;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\CanBeWired;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;
use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;

class Radio extends AbstractComponentAlias
{
    use HasId;
    use HasName;
    use HasLabel;
    use HasValidation;
    use CanBeWired;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        public string $name,
        public array $group,
        protected string|null $id = null,
        protected array|object|null $bind = null,
        protected string|false|null $label = null,
        protected int|string|null $checked = null,
        public string|null $caption = null,
        protected string|null $errorBag = null,
        public bool $marginBottom = true,
        public bool $inline = false
    ) {
        $this->displayValidationSuccess = $this->shouldDisplayValidationSuccess();
        $this->displayValidationFailure = $this->shouldDisplayValidationFailure();
        parent::__construct();
    }

    public function getGroupModeCheckedStatus(int|string $value): bool
    {
        if (old($this->name)) {
            return (string) old($this->name) === (string) $value;
        }
        if ($this->checked) {
            return (string) $this->checked === (string) $value;
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return (string) data_get($dataBatch, $this->name) === (string) $value;
    }

    protected function setViewPath(): string
    {
        return 'radio';
    }

    protected function setUp(Field $field): void
    {
        // TODO: Implement setUp() method.
    }
}
