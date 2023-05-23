<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Livewire\Component;

trait InteractWithLivewire
{
    public function saveDatasForm(Component $livewire): void
    {
        if ($this->hasRules()) {
            $datas = $livewire->validate(rules: $this->getFormRules(), attributes: $this->getAttributesRules());
            if ( ! $livewire->data?->exists) {
                $livewire->data?->fill($this->values($datas))->save();
                if ($edit_url = $this->linkEdit($livewire->data)) {
                    redirect(to: $edit_url);
                }
            } else {
                $livewire->data->update($this->values($datas));
            }
        }
    }
}
