<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\Action;

abstract class FormAction extends Action
{
    protected string $livewireData = 'mountFormActionData';

    /** @var Field[] */
    protected array $fields;

    protected string $statusForm = Form::CREATED;

    public function setUp(string $fieldPath): void
    {
        $this->wireClick("mountFormAction('{$fieldPath}','CreateOption')");
    }

    protected function getLivewireData(string $name): mixed
    {
        $path = $this->livewireData . '.' . $name;

        return data_get($this->livewire, $path, null);
    }

    /**
     * @param  Field[]  $fields
     * @return $this
     */
    public function schemas(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function fill(Model $model): void
    {
        foreach ($this->fields as $field) {
            $model->{$field->getName()} = $this->getLivewireData($field->getName());
            $field->record($model);
            $field->setPrefixPath($this->livewireData);
            $field->statusForm($this->statusForm);
            $field->hydrateState();
        }
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getTitleForModal(): ?string
    {
        if ($this->hasLabel()) {
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

    public function record(Model $record): static
    {
        $this->record = $record;
        $this->fill($this->record);

        return $this;
    }

    public function handleAction(): void
    {
        $this->evaluate(closure: $this->action, include: ['rules' => $this->getRulesFields(), 'attributes' => $this->attributesFields(), 'status' => $this->statusForm]);
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
