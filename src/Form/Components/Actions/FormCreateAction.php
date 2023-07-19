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
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

class FormCreateAction extends FormAction
{
    protected ?FormDialog $formDialog = null;

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
            ->icon('heroicon-o-plus');
    }

    public static function make(string $name): FormCreateAction
    {
        return new self($name);
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
                $field->record($model);
                $field->setPrefixPath('mountFormActionData');
                $field->statusForm($this->statusForm);
                $field->hydrateState();
            }
        }
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
}
