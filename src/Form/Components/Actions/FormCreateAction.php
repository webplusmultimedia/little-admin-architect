<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
use Webplusmultimedia\LittleAdminArchitect\Support\Action\Action as ActionAlias;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

class FormCreateAction extends ActionAlias
{
    protected ?FormDialog $formDialog = null;

    /** @var Field[] */
    protected array $fields;

    protected string $statusForm = Form::CREATED;

    public static function make(): FormCreateAction
    {
        return new self();
    }

    public function schemas(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function fill(Model $model): void
    {
        foreach ($this->fields as $field) {
            if (in_array(get_class($field), [Input::class, DateTimePicker::class, CheckBox::class, Radio::class]) and ! $field->isHiddenOnForm()) {
                $field->record($model);
                $field->setPrefixPath('mountFormActionData');
                $field->statusForm($this->statusForm);
                $field->hydrateState();
            }
        }
    }
}
