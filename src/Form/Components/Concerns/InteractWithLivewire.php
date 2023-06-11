<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait InteractWithLivewire
{
    public function saveDatasForm(): void
    {
        if ($this->hasRules()) {
            $datas = $this->livewire->validate(rules: $this->getFormRules(), attributes: $this->getAttributesRules());
            if ( ! $this->livewire->data?->exists) {
                $this->livewire->data?->fill($this->values($datas))->save();
                if ($this->hasModal()) {
                    $this->livewire->dispatchBrowserEvent($this->eventForCloseModal);
                } elseif ($edit_url = $this->linkEdit($this->livewire->data)) {
                    redirect(to: $edit_url);
                }
                $this->livewire->notification()->success(trans('little-admin-architect::form.message.success'))->send();
            } else {
                $this->livewire->data->update($this->values($datas));
                if ($this->hasModal()) {
                    $this->livewire->dispatchBrowserEvent($this->eventForCloseModal);
                }
                $this->livewire->notification()->success(trans('little-admin-architect::form.message.success'))->send();
            }
        }
    }
}
