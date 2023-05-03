<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\CanBeWireModifier;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasHelperText;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasPlaceHolder;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasRequired;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;


abstract class Field
{
    use HasRules;
    use HasSchema;
    use HasHelperText;
    use HasPlaceholder;
    use CanBeWireModifier;
    use HasRequired;
    use HasLabel;

    final public function __construct(
        public string  $name,
        protected ?string $label = NULL,
    )
    {

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

}
