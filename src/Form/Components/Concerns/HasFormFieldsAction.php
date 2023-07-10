<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\FormCreateAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;

trait HasFormFieldsAction
{
    /** @var array<string,FormCreateAction> */
    protected array $formActions = [];

    protected function getFormsAction(): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field instanceof Select and $field->hasFormAction) {

            }
        }
    }
}
