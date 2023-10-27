<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasMinMaxLength;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasTranslation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Enums\InputType;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

final class Input extends Field
{
    use HasMinMaxLength;
    use HasTranslation;

    protected string $view = 'little-views::form-components.fields.input';

    protected InputType $type = InputType::Text;

    private null | int | float | string $step = null;

    private ?string $inputMode = null;

    public function type(InputType $type): static
    {
        if (InputType::Slug === $type) {
            //$this->disabled();
            $this->helperText('Merci de ne pas remplir');
            $type = InputType::Text;
        }
        $this->type = $type;

        return $this;
    }

    public function getType(): InputType
    {
        return $this->type;
    }

    public function email(): Input
    {
        $this->type = InputType::Email;
        $this->addRules('email');

        return $this;
    }

    public function numeric(): Input
    {
        $this->type = InputType::Number;
        $this->step(1);
        $this->inputMode = 'numeric';
        $this->addRules('numeric');

        return $this;
    }

    public function decimal(): Input
    {
        $this->type = InputType::Number;
        $this->step = 'any';
        $this->inputMode = 'decimal';
        $this->addRules('numeric');

        return $this;
    }

    public function url(): Input
    {
        $this->type = InputType::Url;
        $this->addRules('url');

        return $this;
    }

    public function confirmed(): Input
    {
        $this->addRules('confirmed');

        return $this;
    }

    public function password(): Input
    {
        $this->type = InputType::Password;

        return $this;
    }

    public function step(int | float $step): Input
    {
        $this->step = $step;

        return $this;
    }

    public function getStep(): null | float | int | string
    {
        return $this->step;
    }

    public function inputMode(string $mode): Input
    {
        $this->inputMode = $mode;

        return $this;
    }

    public function getInputMode(): ?string
    {
        return $this->inputMode;
    }

    public function setUp(): void
    {
        if (InputType::Text !== $this->getType() and $this->HasTranslated()) {
            $this->isTranslate = false;
        }
        if ($this->HasTranslated()) {
            $this->name = $this->name . '-translations';
            $this->setTranslateName($this->getStatePath());
            $this->addRules('array');

            $this->afterStateHydrated(static function (string | null | array $state, Input $component): void {
                if (blank($state)) {
                    //Initialize $state for spatie/laravel-translatable
                    $state = data_get($component->livewire, 'data.translations.' . str($component->name)->beforeLast('-translations')->toString());
                    if ( ! $state) {
                        $state = [];
                        foreach (Form::getTranslatedLangues() as $langue) {
                            $state[$langue] = '';
                        }
                    } else {
                        foreach (Form::getTranslatedLangues() as $langue) {
                            if ( ! isset($state[$langue])) {
                                $state[$langue] = ''; // Define missing translation
                            }
                        }
                    }
                    $component->state($state);

                }
            });

            $this->afterStateDehydratedUsing(static function (?array $state, Input $component): array {
                if (null === $state) {
                    $state = data_get($component->livewire, 'data.translations.' . str($component->name)->beforeLast('-translations')->toString());
                }

                return $state;
            });
        }

        $this->setViewDatas('field', $this);
    }
}
