<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait InteractWithWrapper
{
    protected string $wrapperView = 'little-form::partials.wrapper';

    public function getWrapperView(): string
    {
        return $this->wrapperView;
    }

    public function getWrapperId()
    {
        return str($this->name)->pipe('md5')->append('-', $this->getWireName());
    }
}
