<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeWireModifier;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasHelperText;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasPlaceHolder;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasRequired;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasValidationRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;


abstract class Field
{
    use HasValidationRules;
    use HasSchema;
    use HasHelperText;
    use HasPlaceholder;
    use CanBeWireModifier;
    use HasRequired;
    use HasLabel;
    use CanBeDisabled;

    private string $prefixName = 'data';
    protected string $view = 'form::input';

    protected ?Model $record = null;

    final public function __construct(
        public string     $name,
        protected ?string $label = NULL,
    )
    {
    }

    public function getWireName(): string
    {
        return $this->prefixName . '.' . $this->name;
    }

    public function getFieldView(): string
    {
        return $this->view;
    }

    public static function make(string $name, null|string $label = NULL): static
    {
        return new static(name: $name, label: $label);
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function record(Model $model): static
    {
        $this->record = $model;
        return $this;
    }

    public function getRecord(): ?Model
    {
        return $this->record;
    }

}
