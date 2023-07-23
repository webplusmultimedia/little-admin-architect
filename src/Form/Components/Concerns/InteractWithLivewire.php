<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;

/** @property BaseForm $livewire */
trait InteractWithLivewire
{
    public function saveDatasForm(): void
    {
        if ($this->hasRules()) {
            if ($this->livewire instanceof BaseForm) {
                /** @TODO : Validate with laravel Validation */
                $datas = $this->livewire->validate(rules: $this->getRulesBeforeValidate(), attributes: $this->getAttributesRules());
                $this->livewire->form->authorizeAccess();
                if ( ! $this->livewire->data?->exists) {
                    $datas = $this->pageForResource::getMutateFormDataBeforeCreate($this->values($datas));
                    $this->livewire->data?->fill($datas)->save();
                    $this->saveRelations();
                    if ($this->hasModal()) {
                        $this->livewire->dispatchBrowserEvent($this->eventForCloseModal);
                    } elseif ($edit_url = $this->linkEdit($this->livewire->data)) {
                        redirect(to: $edit_url);
                    }
                    $this->livewire->notification()->success(trans('little-admin-architect::form.message.success'))->send();
                } else {
                    $datas = $this->pageForResource::getMutateFormDataBeforeSave($this->values($datas));
                    $this->livewire->data->update($datas);
                    $this->saveRelations();
                    if ($this->hasModal()) {
                        $this->livewire->dispatchBrowserEvent($this->eventForCloseModal);
                    }
                    $this->livewire->notification()->success(trans('little-admin-architect::form.message.success'))->send();
                }
            }
        }
    }

    protected function saveRelations(): void
    {
        if ($this->hasDatasRelationshipForSave) {
            foreach ($this->datasRelation as $name => $value) {
                //@Todo : get the name and check if having fields to save in the relationship for fieldSet component (morphMany, hasMany ...)
                if ($this->livewire->data->{$name}() instanceof BelongsToMany) {
                    $this->livewire->data->{$name}()->sync($value);
                }
            }
        }

    }
}
