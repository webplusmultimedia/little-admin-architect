<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats\FormAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\ValidateValuesForRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\CanGetAttributesRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\CanInteractWithRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\CanValidateValuesForRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanBeDisabled;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanBeHidden;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanBeRequired;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanBeWireModifier;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanDehydrate;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanEmitClearEvent;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanHideOnForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanHydrate;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\CanInitValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasColSpan;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasComponentActions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasHelperText;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasId;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasMessageBag;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasMinMaxValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasPlaceHolder;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasState;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasValidationRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\InteractWithAttributeRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\InteractWithRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\InteractWithWrapper;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\CanEvaluateParameters;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\HasRelationship;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractsWithEvaluateParameters;

abstract class Field extends AbstractField implements CanGetAttributesRules, CanInteractWithRules, CanValidateValuesForRules
{
    use CanBeDisabled;
    use CanBeHidden;
    use CanBeRequired;
    use CanBeWireModifier;
    use CanDehydrate;
    use CanEmitClearEvent;
    use CanEvaluateParameters;
    use CanHideOnForm;
    use CanHydrate;
    use CanInitValue;
    use HasColSpan;
    use HasComponentActions;
    use HasDefaultValue;
    use HasHelperText;
    use HasId;
    use HasLabel;
    use HasMessageBag;
    use HasMinMaxValues;
    use HasName;
    use HasPlaceholder;
    use HasRelationship;
    use HasState;
    use HasValidationRules;
    use InteractsWithEvaluateParameters;
    use InteractWithAttributeRules;
    use InteractWithRules;
    use InteractWithWrapper;
    use ValidateValuesForRules;

    /**
     * @var array<string,string>|Model|null
     */
    protected array | null | Model $record = null;

    public BaseForm | BaseTable | Component $livewire;

    protected mixed $oldValue = null;

    public bool $hasFormAction = false;

    protected ?FormAction $formAction = null;

    final public function __construct(
        string $name,
        string $label = null,
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->setViewDatas('field', $this);

    }

    public function livewire(BaseForm | BaseTable | Component $livewire): void
    {
        $this->livewire = $livewire;
    }

    public static function make(string $name, string $label = null): static
    {
        return new static(name: $name, label: $label);
    }

    public function record(array | null | Model $record): void
    {
        $this->record = $record;
    }

    public function getRecord(): array | null | Model
    {
        return $this->record;
    }

    public function getDefaultParameters(): array
    {
        return ['set' => $this->set(), 'get' => $this->get(), 'state' => $this->getState(), 'status' => $this->getStatusForm(), 'component' => $this];
    }

    public function setUp(): void
    {
    }

    public function getFormAction(): ?FormAction
    {
        return $this->formAction;
    }

    public function hasFormAction(): bool
    {
        return null !== $this->formAction;
    }
}
