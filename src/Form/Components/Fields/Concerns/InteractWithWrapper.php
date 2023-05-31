<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait InteractWithWrapper
{
    protected string $wrapperView = 'little-form::partials.wrapper';

    public function getWrapperView(): string
    {
        return $this->wrapperView;
    }

    public function getWrapperId(): string
    {
        return str($this->name)->pipe('md5')->append('-', $this->getWireName())->value();
    }
}
