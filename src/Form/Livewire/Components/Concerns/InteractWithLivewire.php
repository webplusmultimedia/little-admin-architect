<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Livewire\Component;

trait InteractWithLivewire
{
    public function saveDatasForm(Component $livewire): void
    {
        if ($this->hasRules()) {
            $datas = $livewire->validate(rules: $this->getRules(), attributes: $this->getAttributesRules());
            if ( ! $livewire->data?->exists) {
                $livewire->data?->fill($this->values($datas))->save();
                if ($edit_route = $this->getEditRoute($livewire->routeName)) {
                    redirect()->route($edit_route, ['record' => $livewire->data->id]);
                }
            } else {
                $livewire->data->update($this->values($datas));
            }
        }
    }

    protected function getEditRoute(?string $routeName): ?string
    {
        if (str($routeName)->endsWith('create')) {
            return (string) str($routeName)->beforeLast('.')->append('.record.edit');
        }

        return null;
    }
}
