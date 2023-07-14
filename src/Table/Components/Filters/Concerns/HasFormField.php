<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasFormField
{
    /**
     * @var Field[]|string|Closure
     */
    protected array|Closure|string $formFields = CheckBox::class;

    protected Field|array|null $fields = null;

    public function getFormFields(): array
    {
        if (null === $this->fields) {
            if (is_callable($this->formFields)) {
                $fields = $this->evaluate($this->formFields);
                /** @var Field $field */
                foreach ($fields as $field) {
                    $field->name($this->getFilterPath())
                        ->label($this->label)
                        ->reactive()
                        ->setPrefixPath($this->prefixPath);
                }
                $this->fields = $fields;
            }
            if (is_string($this->formFields) and is_a($this->formFields, Field::class, true)) {
                $field = $this->formFields::make($this->getFilterPath())->reactive()->label($this->label);
                $field->setPrefixPath($this->prefixPath);
                $this->fields = [$field];
            }
        }

        return $this->fields;
    }

    /**
     * @param  Field[]|string|Closure  $formField
     */
    public function form(array|string|Closure $formField): static
    {
        $this->formFields = $formField;

        return $this;
    }
}
