<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasButton
{
    protected string $action;

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }
    protected string $type;
    protected string $caption;



    public function hasButton(): bool
    {
        return isset($this->action) && isset($this->type, $this->caption)  ;
    }
}
