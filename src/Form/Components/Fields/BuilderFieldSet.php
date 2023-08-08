<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet\HasActions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToManyRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBuilderFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;

class BuilderFieldSet extends Field
{
    use HasActions;
    use HasBelongToManyRelation;
    use HasBuilderFields;
    use HasGridColumns;

    protected string $view = 'builder-field-set';

    protected string $keyField = 'record-';

    protected string $colSpan = 'lg:col-span-full';

    //protected ?string $prefixPath = 'record';

    public function setUp(): void
    {
        //$this->setPrefixPath(str($this->prefixPath)->append('.',$this->getName()));
        $this->setViewDatas('field', $this);

        $this->actions = $this->getActions();

        $this->afterStateHydrated(static function (?array $state, BuilderFieldSet $component): void {

            if (blank($state)) {
                $component->state([
                    /* 'record-1' => ['marge' => 'test', 'at' => NULL],
                     'record-2' => ['marge' => 'test2', 'at' => NULL],*/
                ]);

                return;
            }

            if (is_array($state) and ! str((string) key($state))->startsWith($component->keyField)) {

                $values = collect($state)
                    ->map(fn (array $value, int $key) => [str($component->keyField)->append($key)->value() => $value])
                    ->collapse()
                    ->toArray();
                $component->state($values);
            }

            /** @var array $values */
            foreach ($component->getState() as $keyField => $values) {
                $component->addFields($component->addFormFieldsByName($keyField), $keyField);
            }

            foreach ($component->fields as $items) {
                foreach ($items as $item) {
                    $item->hydrateState();
                }
            }

        });

        $this->setBeforeUpdatedValidateValueUsing(static function (?array $state, BuilderFieldSet $component): bool {
            if (blank($state)) {
                $component->state([]);

                return true;
            }
            $records = collect($state)->values()->toArray();
            $component->state($records);

            return true;
        });
    }

    public function getWireKey(): string
    {
        $title = Str::random(5);

        return (string) str($this->getStatePath())->append('-', str($title)->kebab());
    }

    public function hydrateRules(array $rules): array
    {
        foreach ($this->fields as $fields) {
            foreach ($fields as $field) {
                $rules = $field->hydrateRules($rules);
            }
        }

        return $rules;
    }

    public function applyAttributesRules(array $rules): array
    {
        foreach ($this->fields as $fields) {
            foreach ($fields as $field) {
                $rules = $field->applyAttributesRules($rules);
            }
        }

        return $rules;
    }

    public function applyDefaultValue(): void
    {
        $values = [];
        foreach ($this->fields as $key => $fields) {
            $valuesFields = [];
            /** @var Field $field */
            foreach ($fields as $field) {
                $valuesFields[$field->getName()] = $field->defaultValue ?? $field->getState();
            }
            $values[$key] = $valuesFields;
        }
        $this->state($values);

    }

    public function beforeSaveRulesUsing(array $rules): array
    {
        foreach ($this->fields as $items) {
            foreach ($items as $item) {
                $rules = $item->beforeSaveRulesUsing($rules);
            }
        }

        return $rules;
    }

    public function addFieldsToFieldSet(): void
    {
        /** @var array $state */
        $state = $this->getState();
        $count = count($state);
        $keyField = str($this->keyField)->append($count)->value();
        $value = [];
        foreach ($this->formSchemas as $formSchema) {
            $value[$formSchema->getName()] = $formSchema->defaultValue;
        }
        $state = array_merge($state, [$keyField => $value]);
        $this->state($state);

        $this->addFields($this->addFormFieldsByName($keyField), $keyField);

    }

    protected function deleteFieldToFieldSet(string $key): void
    {
        //dump($key);
    }

    protected function reorderFieldToFieldSet(array $keys): void
    {
        //dump($keys);
    }
}
