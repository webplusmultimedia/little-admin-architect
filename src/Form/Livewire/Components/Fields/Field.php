<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\ValidateValuesForRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\CanGetAttributesRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\CanInteractWithRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\CanValidateValuesForRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeNullable;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeRequired;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeWireModifier;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasHelperText;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasPlaceHolder;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasValidationRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\InteractWithAttributeRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\InteractWithRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\InteractWithWrapper;

abstract class Field implements CanValidateValuesForRules, CanGetAttributesRules, CanInteractWithRules
{
    use HasValidationRules;
    use HasHelperText;
    use HasPlaceholder;
    use CanBeWireModifier;
    use CanBeRequired;
    use CanBeNullable;
    use HasLabel;
    use CanBeDisabled;
    use HasColSpan;
    use ValidateValuesForRules;
    use InteractWithAttributeRules;
    use InteractWithRules;
    use InteractWithWrapper;

    private string $prefixName = 'data';

    protected string $view = 'input';

    protected ?Model $record = null;

    final public function __construct(
        public string $name,
        protected ?string $label = null,
    ) {
    }

    public function getWireName(): string
    {
        return $this->prefixName.'.'.$this->name;
    }

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix').'::'.$this->view;
    }

    public static function make(string $name, null|string $label = null): static
    {
        return new static(name: $name, label: $label);
    }

      protected function record(Model $model): void
      {
          $this->record = $model;
      }

    public function getRecord(): ?Model
    {
        return $this->record;
    }

    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix').'::'.$view;
    }
}
