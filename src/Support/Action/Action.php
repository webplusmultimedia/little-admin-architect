<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\DateTimePicker;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\FormDialog;

class Action extends \Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\Action
{
    protected ?string $view = 'little-views::action.table-action';

    protected ?FormDialog $formDialog = null;

    /** @var Field[] */
    protected array $fields = [];

    protected string $statusForm = Form::CREATED;

    final public function __construct()
    {

    }

    public static function make(): static
    {
        return new static();
    }

    public function schemas(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function fill(Model $model): void
    {
        foreach ($this->fields as $field) {
            if (in_array(get_class($field), [Input::class, DateTimePicker::class, CheckBox::class, Radio::class, Select::class])) {
                $field->record($model);
                $field->setPrefixPath('mountFormActionData');
                $field->statusForm($this->statusForm);
                $field->hydrateState();
            }
        }
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
