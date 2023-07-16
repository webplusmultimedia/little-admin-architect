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
            $this->fields = $this->setUp();
            if (is_callable($this->formFields) or is_array($this->formFields)) {
                $fields = $this->evaluate($this->formFields);
                /** @var Field $field */
                foreach ($fields as $field) {
                    $field->name($this->getFilterPath($field))
                        ->reactive(false)
                        ->setPrefixPath($this->prefixPath);
                }
                $this->fields = $fields;
            }

        }

        return $this->fields;
    }

    /**
     * @param  Field[]|Closure  $formField
     */
    public function form(array|Closure $formField): static
    {
        $this->formFields = $formField;

        return $this;
    }
}
