<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Actions;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\HasIcon;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\AbstractField;

class Button extends AbstractField
{
    use HasIcon;

    protected string $view = 'button';
    protected array $acceptedTypes = ['link', 'submit'];

    final public function __construct(
        protected string      $caption,
        protected string      $type = 'link',
        protected null|string $action = null,
    ) {
        $this->view .= $this->type;
    }

    public static function make(string $caption, string $type = 'link', null|string $action = null): Button
    {
        return new self(caption: $caption, type: $type, action: $action);
    }

    public function getAction(): null|string
    {
        return $this->action;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

}
