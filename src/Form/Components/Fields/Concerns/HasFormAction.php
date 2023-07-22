<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\FormCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Textarea;

trait HasFormAction
{
    /**
     * @param  Field[]  $schemas
     */
    public function createOptionForm(array $schemas, string $label = null): static
    {
        $fields = [];
        foreach ($schemas as $schema) {
            if (in_array(get_class($schema), [Input::class, DateTimePicker::class, CheckBox::class, Radio::class, Select::class, Textarea::class]) /*and ! $field->isHiddenOnForm()*/) {
                $fields[] = $schema;
            }
        }
        $this->formAction = FormCreateAction::make('create-option')
            ->schemas(fields: $fields)->withoutLabel();
        if ($label) {
            $this->formAction->label($label);
        }
        $this->hasFormAction = true;

        return $this;
    }
}
