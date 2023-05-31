<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Form;

trait InteractWithLivewire
{
    public function saveDatasForm(Form $livewire): void
    {
        if ($this->hasRules()) {
            $datas = $livewire->validate(rules: $this->getFormRules(), attributes: $this->getAttributesRules());
            if ( ! $livewire->data?->exists) {
                $livewire->data?->fill($this->values($datas))->save();
                if ($this->hasModal()) {
                    $livewire->dispatchBrowserEvent($this->eventForCloseModal);
                } elseif ($edit_url = $this->linkEdit($livewire->data)) {
                    redirect(to: $edit_url);
                }
            } else {
                $livewire->data->update($this->values($datas));
                if ($this->hasModal()) {
                    $livewire->dispatchBrowserEvent($this->eventForCloseModal);
                }
            }
        }
    }
}
