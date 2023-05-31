<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\ValidateValuesForRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\CanGetAttributesRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\CanInteractWithRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\CanValidateValuesForRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeHidden;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeRequired;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeWireModifier;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanInitValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasHelperText;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasId;
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
    use CanBeHidden;
    use CanBeRequired;
    use CanBeWireModifier;
    use CanInitValue;
    use HasColSpan;
    use HasDefaultValue;
    use HasHelperText;
    use HasId;
    use HasLabel;
    use HasName;
    use HasPlaceholder;
    use HasValidationRules;
    use InteractWithAttributeRules;
    use InteractWithRules;
    use InteractWithWrapper;
    use ValidateValuesForRules;

    /**
     * @var array<string,string>|Model|null
     */
    protected array|null|Model $record = null;

    final public function __construct(
        string $name,
        ?string $label = null,
    ) {
        $this->label = $label;
        $this->name = $name;
    }

    public function getWireName(): string
    {
        return $this->getPrefix() . $this->name;
    }

    public function getDataRecord(): mixed
    {
        if ($this->record instanceof Model) {
            return $this->getValue();
        }
        /*if (is_array($this->record)) {
            if (isset($this->record[$this->getName()])) {
                return $this->record[$this->getName()];
            }
        }*/

        return null;
    }

    protected function getPrefix(): string
    {
        if ($this->record instanceof Model) {
            return $this->prefixName . '.';
        }

        return '';
    }

    public static function make(string $name, null|string $label = null): static
    {
        return new static(name: $name, label: $label);
    }

    public function record(array|null|Model $record): void
    {
        $this->record = $record;
    }

    public function getRecord(): array|null|Model
    {
        return $this->record;
    }
}
