<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats\FormAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

class FormCreateAction extends FormAction
{
    protected ?string $view = 'little-views::action.form-action';

    /** @var Field[] */
    protected array $fields;

    protected string $statusForm = Form::CREATED;

    public function setUp(string $fieldPath): void
    {
        $this->wireClick("mountFormAction('{$fieldPath}','CreateOption')");
    }

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

    public function handleAction(): void
    {
        $this->evaluate(closure: $this->action, include: ['rules' => $this->getRulesFields(), 'attributes' => $this->attributesFields(), 'status' => $this->statusForm]);
    }

    public function record(Model $record): static
    {
        $this->record = $record;
        $this->fill($this->record);

        return $this;
    }

    public function authorize(): bool
    {
        if ($this->livewire && $this->livewire instanceof BaseForm) {
            return $this->livewire->form->getResourcePage()::canCreate();
        }

        return true;
    }

    public function schemas(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function fill(Model $model): void
    {
        foreach ($this->fields as $field) {
            if (in_array(get_class($field), [Input::class, DateTimePicker::class, CheckBox::class, Radio::class, Select::class]) /*and ! $field->isHiddenOnForm()*/) {

                $model->{$field->getName()} = $this->getLivewireData($field->getName());

                $field->record($model);

                $field->setPrefixPath($this->livewireData);
                $field->statusForm($this->statusForm);

                $field->hydrateState();
            }
        }
        //dd($this->record);
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getTitleForModal(): ?string
    {
        if ($this->label) {
            return $this->getLabel();
        }

        if ($this->record) {
            $name = str(get_class($this->record))
                ->afterLast('\\')
                ->singular()
                ->value();

            return "Create {$name}";
        }

        return null;
    }

    private function getRulesFields(): array
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules = $field->beforeSaveRulesUsing(rules: $rules);
        }

        return $rules;
    }

    private function attributesFields(): array
    {
        $attributesRules = [];
        foreach ($this->fields as $field) {
            $attributesRules = $field->applyAttributesRules($attributesRules);
        }

        return $attributesRules;
    }
}
