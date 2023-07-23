<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats\FormAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FileUpload;

class CustomPropertiesCreateAction extends FormAction
{
    protected ?string $view = 'little-views::action.form-action';

    public function __construct(protected ?string $name)
    {
        $this->roundedFull()
            ->bgTransparent()
            ->icon('heroicon-o-plus')
            ->mediumIconSize()
            ->classesStyle('bg-primary-100 hover:bg-primary-200')
            ->action(function (?array $record, BaseForm $livewire, array $rules, array $attributes, int $key): void {

                /** @var array $values */
                $values = $livewire->validate(rules: $rules, attributes: $attributes);
                $values = collect($values)->values()->collapse()->all();
                $field = $livewire->form->getFormFieldByPath($livewire->mountFormActionComponent);
                if ($field instanceof FileUpload) {
                    $state = $field->getState();
                    if (isset($state[$key])) {
                        $state[$key]['customProperties'] = $values;
                        $field->setState($state);
                    }
                }

            })->maxWidthMedium();
    }

    public static function make(string $name): CustomPropertiesCreateAction
    {
        return new self($name);
    }

    protected function getLivewireData(string $name): mixed
    {
        $path = $this->livewireData . '.' . $name;

        return data_get($this->livewire, $path, null);
    }

    public function beforeFill(): void
    {
        $record = data_get($this->livewire, $this->livewireData);
        //store record custom properties
        if (blank($record) and isset($this->record[data_get($this->livewire, $this->livewireFormKey)])) {
            $datas = $this->record[data_get($this->livewire, $this->livewireFormKey)]; // one file-upload (might be {file,delete,id} with/without customProperties
            if (isset($datas['customProperties'])) {
                $record = $datas['customProperties'];
            } else {
                foreach ($this->fields as $field) {
                    if ('alt' === $field->getName()) {
                        $record[$field->getName()] = str($datas['file'])
                            ->beforeLast('.')
                            ->headline()->value();

                        continue;
                    }
                    $record[$field->getName()] = null;
                }
            }
        }
        data_set($this->livewire, $this->livewireData, $record);
        $this->record = $record;

        $this->fill($record);
    }

    public function fill(Model|array $model): void
    {
        foreach ($this->fields as $field) {
            $field->record($model);
            $field->livewire($this->livewire);
            $field->setPrefixPath($this->livewireData);
            $field->statusForm($this->statusForm);
            $field->hydrateState();
        }
    }

    public function authorize(): bool
    {
        if ($this->livewire && $this->livewire instanceof BaseForm) {
            return $this->livewire->form->getResourcePage()::canCreate();
        }

        return true;
    }

    public function handleAction(): void
    {
        $this->evaluate(closure: $this->action, include: [
            'rules' => $this->getRulesFields(),
            'attributes' => $this->attributesFields(),
            'key' => data_get($this->livewire, $this->livewireFormKey),
        ]);
    }
}
