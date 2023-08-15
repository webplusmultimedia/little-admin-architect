<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FieldException;

/** @property BaseForm $livewire */
trait InteractWithLivewire
{
    public function saveDatasForm(): void
    {
        if ($this->hasRules()) {
            if ($this->livewire instanceof BaseForm) {
                //dd($this->getRulesBeforeValidate(),$this->livewire->data);
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
            try {

                DB::beginTransaction();
                foreach ($this->datasRelation as $name => $value) {
                    //@Todo : get the name and check if having fields to save in the relationship for fieldSet component (morphMany, hasMany ...)
                    $relationship = $this->livewire->data->{$name}();
                    if ($relationship instanceof BelongsToMany) {
                        $relationship->sync($value);
                    }
                    if ($relationship instanceof HasMany) {
                        /** @var array<string,array> $value */
                        $datas = collect($value)->values()->all();
                        $relationship->delete();
                        $relationship->createMany($datas);
                        $this->livewire->data->refresh();
                    }
                    DB::commit();
                }
            } catch (Exception $e) {
                DB::rollBack();
                throw new FieldException('A problem causing by saving relationship');
            }
        }

    }
}
