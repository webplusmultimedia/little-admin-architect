<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats\FormAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;

class FormCreateAction extends FormAction
{
    protected ?string $view = 'little-views::action.form-action';

    public function __construct(protected ?string $name)
    {
        $this->roundedFull()
            ->bgTransparent()
            ->icon('heroicon-o-plus')
            ->mediumIconSize()
            ->classesStyle('bg-primary-100 hover:bg-primary-200')
            ->action(function (?Model $record, BaseForm $livewire, array $rules, array $attributes, string $status): void {

                /** @var array $values */
                $values = $livewire->validate(rules: $rules, attributes: $attributes);
                $values = collect($values)->values()->collapse()->all();
                if ($record) {
                    $record->fill($values)->save();

                    $field = $livewire->form->getFormFieldByPath($livewire->mountFormActionComponent);
                    if ($field && $field instanceof Select) {
                        if (is_array($field->getState())) {
                            $field->setState([...$field->getState(), $record->getKey()]);
                            $livewire->dispatchBrowserEvent($field->eventToGetLabel(), $field->getAllLabelsForValues());
                        } else {
                            $field->setState($record->getKey());
                            $livewire->dispatchBrowserEvent($field->eventToGetLabel(), $record->{$field->getLabelField()});
                        }
                    }

                }

            })->maxWidthMedium();
    }

    public static function make(string $name): FormCreateAction
    {
        return new self($name);
    }

    public function authorize(): bool
    {
        if ($this->livewire && $this->livewire instanceof BaseForm) {
            return $this->livewire->form->getResourcePage()::canCreate();
        }

        return true;
    }
}
