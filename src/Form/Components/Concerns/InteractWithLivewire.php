<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;

trait InteractWithLivewire
{
    public function saveDatasForm(): void
    {
        if ($this->hasRules()) {
            if ($this->livewire instanceof BaseForm) {
                /** @TODO : Validate with laravel Validation */
                $datas = $this->livewire->validate(rules: $this->getFormRules(), attributes: $this->getAttributesRules());
                if ( ! $this->livewire->data?->exists) {
                    $datas = $this->pageForResource::getMutateFormDataBeforeCreate($this->values($datas));
                    $this->livewire->data?->fill($datas)->save();
                    if ($this->hasModal()) {
                        $this->livewire->dispatchBrowserEvent($this->eventForCloseModal);
                    } elseif ($edit_url = $this->linkEdit($this->livewire->data)) {
                        redirect(to: $edit_url);
                    }
                    $this->restoreValueAfterSavedUsing();
                    $this->livewire->notification()->success(trans('little-admin-architect::form.message.success'))->send();
                } else {
                    $datas = $this->pageForResource::getMutateFormDataBeforeSave($this->values($datas));
                    $this->livewire->data->update($datas);
                    if ($this->hasModal()) {
                        $this->livewire->dispatchBrowserEvent($this->eventForCloseModal);
                    }
                    $this->restoreValueAfterSavedUsing();
                    $this->livewire->notification()->success(trans('little-admin-architect::form.message.success'))->send();
                }
            }
        }
    }
}
