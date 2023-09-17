<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet\HasActions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\BuilderFieldSet\HasBuilderFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasManyRelation;

class BuilderFieldSet extends Field
{
    use HasActions;
    use HasBuilderFields;
    use HasGridColumns;
    use HasManyRelation;

    protected string $view = 'builder-field-set';

    protected string $keyField = 'record-';

    protected string $colSpan = 'lg:col-span-full';

    protected array $stateTemp = [];

    //protected ?string $prefixPath = 'record';

    public function setUp(): void
    {
        //$this->setPrefixPath(str($this->prefixPath)->append('.',$this->getName()));
        $this->setViewDatas('field', $this);

        if ( ! $this->hasRelationship()) {
            $this->actions = $this->getActions();
            $this->afterStateHydrated(static function (?array $state, BuilderFieldSet $component): void {

                if (blank($state)) {
                    $component->state([
                    ]);

                    return;
                }

                if (is_array($state) and ! str((string) key($state))->startsWith($component->keyField)) {
                    $newState = collect($state)
                        ->map(fn (array $value, int $key) => [str($component->keyField)->append($key)->value() => $value])
                        ->collapse()
                        ->toArray();
                    //if for advertance you add another field when this fiel is filled, you need to add a default value on missing one
                    if (count($component->formSchemas) > count(collect($newState)->first())) {
                        $newState = $component->fillMissingValues($newState);
                    }
                    $component->state($newState);
                }

                $component->fill();
            });

            $this->setBeforeUpdatedValidateValueUsing(static function (?array $state, BuilderFieldSet $component): bool {
                if (blank($state)) {
                    $component->state([]);

                    return true;
                }
                $component->stateTemp = $state;
                $records = collect($state)->values()->toArray();

                $component->state($records);

                return true;
            });

            $this->afterStateDehydratedUsing(static function (?array $state, BuilderFieldSet $component): array {

                if (blank($state)) {

                    return [];
                }

                if (is_array($state) and ! str((string) key($state))->startsWith($component->keyField)) {
                    return $component->stateTemp;
                }

                return $state;
            });
        } else {
            $this->relationship = $this->getName();
            $this->actions = $this->getActions();
            $this->afterStateHydrated(static function (null|array|Collection $state, BuilderFieldSet $component): void {
                if (blank($state)) {
                    $component->state([]);

                    return;
                }

                if ($state instanceof Collection) {
                    $newState = $state
                        ->map(fn (Model $value, int $key) => [str($component->keyField)->append($key)->value() => $value])
                        ->collapse()
                        ->toArray();
                    //if for advertance you add another field when this field is filled, you need to add a default value on missing one
                    if (count($component->formSchemas) > count(collect($newState)->first())) {
                        $newState = $component->fillMissingValues($newState);
                    }
                    $component->state($newState);
                }

                $component->fill();
            });

            $this->setBeforeUpdatedValidateValueUsing(static function (Collection|array $state, BuilderFieldSet $component): bool {
                return false;
            });

            $this->setBeforeCreatedValidateValueUsing(static function (Collection|array $state, BuilderFieldSet $component): bool {
                return false;
            });

            $this->afterStateDehydratedUsing(static function (Collection|array $state, BuilderFieldSet $component): array {
                if (blank($state)) {
                    return [];
                }
                if ($state instanceof Collection) {
                    $newState = $state
                        ->map(fn (Model $value, int $key) => [str($component->keyField)->append($key)->value() => $value])
                        ->collapse()
                        ->toArray();

                    return $newState;
                }

                return $state;
            });
        }
    }

    public function relationship(string $relationship = null, string $labelField = null, Closure $query = null): static
    {
        $this->hasRelationship = true;

        return $this;
    }

    protected function checkRelation(): bool // check if relation in livewire record
    {
        return $this->hasRelationship() and HasMany::class === $this->getRelationType();
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
                $valuesFields[$field->getName()] = $field->getDefaultValue() ?? $field->getState();
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

        $rules[$this->getStatePath() . '.*'] = ['array'];

        return $rules;
    }

    public function addFieldsToFieldSet(): void
    {

        /** @var array $state */
        $state = $this->getState();
        $count = count($state);
        $keyField = str($this->keyField)->append($count)->value(); // @todo : test key when add
        while (array_key_exists($keyField, $state)) {
            $count++;
            $keyField = str($this->keyField)->append($count)->value();
        }
        $value = [];
        foreach ($this->formSchemas as $formSchema) {
            $value[$formSchema->getName()] = $formSchema->getDefaultValue();
        }
        $state = array_merge($state, [$keyField => $value]);
        $this->state($state);

        $this->addFields($this->addFormFieldsByName($keyField), $keyField);
        foreach ($this->fields as $items) {
            foreach ($items as $item) {
                $item->hydrateState();
            }
        }

    }

    protected function deleteFieldToFieldSet(string $key): void
    {
        $state = $this->getState();
        if (isset($state[$key])) {
            unset($state[$key]);

            $newState = [];
            foreach ($state as $k => $value) {
                $newState[$k] = $value;
            }
            $this->state($newState);
            $this->fill();

            return;
        }

        throw new FieldException("Can't find {$key}");
    }

    protected function reorderFieldToFieldSet(array $keys): void
    {
        $state = $this->getState();
        $newState = [];
        foreach ($keys as $key) {
            if (isset($state[$key])) {
                $newState[$key] = $state[$key];
            } else {
                throw new FieldException("Can't find {$key}");
            }
        }
        $this->state($newState);
        $this->fill();
    }
}
