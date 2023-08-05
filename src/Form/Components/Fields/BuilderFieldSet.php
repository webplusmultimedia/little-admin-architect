<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToManyRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBuilderFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;

class BuilderFieldSet extends Field
{
    use HasBelongToManyRelation;
    use HasBuilderFields;
    use HasGridColumns;

    protected string $view = 'builder-field-set';

    protected string $keyField = 'record-';

    //protected ?string $prefixPath = 'record';

    public function setUp(): void
    {
        //$this->setPrefixPath(str($this->prefixPath)->append('.',$this->getName()));
        if (blank($this->getState())) {
            $this->state([]);
        }
        /** @var array $values */
        foreach ($this->getState() as $keyField => $values) {
            $fields = [];
            //$record = 0;
            foreach ($this->formSchemas as $field) {
                // $keyField = str($this->keyField)->append($record)->value();
                $pathField = str($this->prefixPath)->append('.', $keyField)->value();
                $field->setPrefixPath($pathField);
                $field->record($this->getState());
                $field->statusForm($this->statusForm);
                $field->livewire($this->livewire);
                $field->setUp();
                $fields[] = $field;
                //$record ++;
            }
            $this->addFields($fields, $keyField);
        }

        $this->afterStateHydrated(function (array $state, BuilderFieldSet $component): void {
            foreach ($component->fields as $fields) {
                foreach ($fields as $field) {
                    $field->hydrateState();
                }
            }
        });
    }
}
