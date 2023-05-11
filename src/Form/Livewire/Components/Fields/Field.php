<?php

declare(strict_types=1);

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
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasPlaceHolder;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasValidationRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\InteractWithAttributeRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\InteractWithRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\InteractWithWrapper;

abstract class Field extends AbstractField implements CanValidateValuesForRules, CanGetAttributesRules, CanInteractWithRules
{
    use CanBeDisabled;
    use CanBeNullable;
    use CanBeRequired;
    use CanBeWireModifier;
    use HasColSpan;
    use HasHelperText;
    use HasLabel;
    use HasName;
    use HasPlaceholder;
    use HasValidationRules;
    use InteractWithAttributeRules;
    use InteractWithRules;
    use InteractWithWrapper;
    use ValidateValuesForRules;

    protected ?Model $record = NULL;

    final public function __construct(
        string  $name,
        ?string $label = NULL,
    )
    {
        $this->label = $label;
        $this->name = $name;
    }

    public function getWireName(): string
    {
        return $this->prefixName . '.' . $this->name;
    }

    public static function make(string $name, null|string $label = NULL): static
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

}
