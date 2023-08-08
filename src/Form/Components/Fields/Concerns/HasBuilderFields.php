<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasBuilderFields
{
    /**
     * @var array<string,Field[]>
     */
    protected array $fields = [];

    /**
     * @var Field[]
     */
    protected array $formSchemas = [];

    /**
     * @param  Field[]  $schemas
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

    /**
     * @param  Field[]  $field
     */
    protected function addFields(array $field, string $key): void
    {
        $this->fields[$key] = $field;
    }

    public function getFormFields()
    {
        $formFields = [];

    }
}
