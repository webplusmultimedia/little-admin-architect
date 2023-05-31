<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasHelperText
{
    protected ?string $helperText = null;

    public function getHelperText(): ?string
    {
        return $this->helperText;
    }

    public function helperText(?string $helperText): static
    {
        $this->helperText = $helperText;

        return $this;
    }

    public function getViewComponentForHelperText(): string
    {
        return $this->getViewComponent('partials.caption');
    }
}
