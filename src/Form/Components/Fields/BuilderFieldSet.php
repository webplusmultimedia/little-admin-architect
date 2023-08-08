<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet\HasActions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToManyRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBuilderFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

class BuilderFieldSet extends Field
{
    use HasBelongToManyRelation;
    use HasBuilderFields;
    use HasGridColumns;
    use HasActions;

    protected string $view = 'builder-field-set';

    protected string $keyField = 'record-';
    protected string $colSpan = 'lg:col-span-full';

    //protected ?string $prefixPath = 'record';

    public function setUp(): void
    {
        //$this->setPrefixPath(str($this->prefixPath)->append('.',$this->getName()));
        $this->setViewDatas('field', $this);

        $this->actions = $this->getActions();

        $this->afterStateHydrated(static function (array|null $state, BuilderFieldSet $component): void {


            if (blank($state)) {
                $component->state([
                    'record-1' => ['marge' => 'test', 'at' => NULL],
                    'record-2' => ['marge' => 'test2', 'at' => NULL],
                ]);
            }


            /** @var array $values */
            foreach ($component->getState() as $keyField => $values) {
                $fields = [];
                //$record = 0;

                foreach ($component->formSchemas as $formField) {
                    // $keyField = str($this->keyField)->append($record)->value();
                    $pathField = str($component->getStatePath())->append('.', $keyField)->value();

                    $field = clone $formField;
                    $field->setPrefixPath($pathField);
                    $field->record($component->getState());
                    $field->statusForm($component->statusForm);
                    $field->livewire($component->livewire);

                    $field->setUp();
                    $fields[] = $field;
                    //$record ++;
                }
                $component->addFields($fields, $keyField);

            }

            foreach ($component->fields as $items) {
                foreach ($items as $item) {
                    $item->hydrateState();
                }
            }

        });

        $this->setBeforeUpdatedValidateValueUsing(static function (array|null $state, BuilderFieldSet $component): bool {
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
        $title =  Str::random(5);

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
}
