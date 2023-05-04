<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

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

    public function getViewComponentForHelperText()
    {
        return $this->getViewComponent('partials.caption');
    }
}
