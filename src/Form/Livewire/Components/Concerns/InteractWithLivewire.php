<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

Trait InteractWithLivewire
{
    public function saveDatasForm(Component $livewire): void
    {

        if ($this->hasRules()){
            $datas = $livewire->validate(rules: $this->getRules(),attributes: $this->getAttributesRules());
            if (! $livewire->data?->exists) {
                $livewire->data?->fill($this->values($datas))->save();
                if ($edit_route = $this->getEditRoute()){
                    redirect()->route($edit_route,['record'=>$livewire->data->id]);
                }
            } else {
                $livewire->data->update($this->values($datas));
            }
        }
    }

    protected function getEditRoute(): ?string
    {
        if(str(request()->route()->getName())->afterLast('.') === 'create'){
            return str(request()->route()->getName())->beforeLast('.')->append('.edit')->value();
        }
        return NULL;
    }
}
