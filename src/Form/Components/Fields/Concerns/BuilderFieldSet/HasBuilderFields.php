<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasBuilderFields
{
    /**
     * @var array<string,Field[]>
     */
    protected array $fields = [];

    protected bool|Closure $can_deleted = false;

    protected bool|Closure $can_reorder = false;

    /**
     * @var Field[]
     */
    protected array $formSchemas = [];

    /**
     * @param Field[] $schemas
     */
    public function schema(array $schemas): static
    {
        $this->formSchemas = $schemas;

        return $this;
    }

    /**
     * @return array<string,Field[]>
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function canDeleted(bool|Closure $can_deleted = true): static
    {
        $this->can_deleted = $can_deleted;

        return $this;
    }

    public function canReorder(bool|Closure $can_sort = true): static
    {
        $this->can_reorder = $can_sort;

        return $this;
    }

    public function isDeleted(): bool
    {
        return $this->evaluate($this->can_deleted);
    }

    public function isReordered(): bool
    {
        return $this->evaluate($this->can_reorder);
    }

    /**
     * @param Field[] $field
     */
    protected function addFields(array $field, string $key): void
    {
        $this->fields[$key] = $field;
    }

    public function addFormFields(): void
    {
        $formFields = [];

    }

    protected function addFormFieldsByName(string $keyField): array
    {
        $fields = [];
        //$record = 0;

        foreach ($this->formSchemas as $formField) {
            // $keyField = str($this->keyField)->append($record)->value();
            $pathField = str($this->getStatePath())->append('.', $keyField)->value();

            $field = clone $formField;
            $field->setPrefixPath($pathField);
            $field->record($this->getState());
            $field->statusForm($this->statusForm);
            $field->livewire($this->livewire);
            $field->setParentField($this);

            $field->setUp();
            $fields[] = $field;
            //$record ++;
        }

        return $fields;
    }

    protected function fill(): void
    {
        $this->fields = [];
        $state = $this->getState();
        if (is_array($state)) {
            /** @var array $values */
            foreach ($state as $keyField => $values) {
                $this->addFields($this->addFormFieldsByName($keyField), $keyField);
            }
        }

        foreach ($this->fields as $items) {
            foreach ($items as $item) {
                $item->hydrateState();
            }
        }
    }

    private function fillMissingValues(array $newState): array
    {
        $valueSchema = [];
        foreach ($this->formSchemas as $formSchema) {
            $valueSchema[$formSchema->getName()] = $formSchema->getDefaultValue();
        }

        foreach ($newState as $key => $items) {
            $itemKeys = collect($valueSchema)->diffKeys($items);
            foreach ($itemKeys as $keyItem => $itemKey) {
                $items[$keyItem] = $itemKey;
            }
            $newState[$key] = $items;
        }

        return $newState;
    }

    public function getFormFieldByPath(string $path): ?Field
    {
        foreach ($this->fields as $fields) {
            if ($field = collect($fields)->filter(fn(Field $field) => $field->getStatePath() === $path)->first()) {
                return $field;
            }
        }

        return NULL;
    }

    public function getFormFieldByName(string $name): ?Field
    {
        foreach ($this->fields as $fields) {
            if ($field = collect($fields)->filter(fn(Field $field) => $field->getName() === $name)->first()) {
                return $field;
            }
        }

        return NULL;
    }
}
