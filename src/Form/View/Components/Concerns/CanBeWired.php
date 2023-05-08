<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;

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

    public function getComponentLivewireModifier(): string
    {
        $modifier = $this->getConfig()->getWireModifier();

        return $modifier;
    }

    protected function getFormLivewireModifier(): string
    {
        $formLivewireModifier = app(FormBinder::class)->getBoundLivewireModifer();

        return $formLivewireModifier ? '.'.$formLivewireModifier : '';
    }
}
