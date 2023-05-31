<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasButton
{
    protected string $action;

    public function getAction(): string
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

    protected string $type;

    protected string $caption;

    public function hasButton(): bool
    {
        return isset($this->action) && isset($this->type, $this->caption);
    }
}
