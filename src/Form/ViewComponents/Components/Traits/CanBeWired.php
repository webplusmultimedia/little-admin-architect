<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder;

trait CanBeWired
{
    public function componentIsWired(): bool
    {
        return $this->hasFormLivewireBinding()
            || $this->hasComponentNativeLivewireModelBinding()
            || $this->hasComponentPackageLivewireBinding();
    }

    protected function hasFormLivewireBinding(): bool
    {
        return null !== app(FormBinder::class)->getBoundLivewireModifer();
    }

    public function hasComponentNativeLivewireModelBinding(): bool
    {
        return (bool) $this->attributes->whereStartsWith('wire:model')->first();
    }

    protected function hasComponentPackageLivewireBinding(): bool
    {
        return $this->attributes->has('wire');
    }

    public function getComponentLivewireModifier(): ?string
    {
        $modifier = $this->getConfig()->getWireModifier()?'.'.$this->getConfig()->getWireModifier():null;
        return $modifier;
    }

    protected function getFormLivewireModifier(): string
    {
        $formLivewireModifier = app(FormBinder::class)->getBoundLivewireModifer();

        return $formLivewireModifier ? '.' . $formLivewireModifier : '';
    }
}
