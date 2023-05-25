<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Actions\Button;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanListOptionsForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanSearchResultsUsingForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\HasFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\HasSelectOptionLabelUsing;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;

final class Form
{
    use CanGetRules;
    use CanInitDatasForm;
    use CanListOptionsForSelect;
    use CanSearchResultsUsingForSelect;
    use CanValidatedValues;
    use HasDefaultValue;
    use HasFields;
    use HasGridColumns;
    use HasSchema;
    use HasSelectOptionLabelUsing;
    use InteractWithLivewire;
    use InteractWithPage;

    protected string $view = 'form';

    /**
     * @var Model|array<string,string>|null
     */
    protected null|Model|array $model = null;

    protected ?string $mode = null;

    protected string $action = 'save';

    protected string $type = 'submit';

    protected string $caption = 'Enregistrer';

    protected Button $buttonSave;

    protected Button $buttonCancel;

    protected ?string $livewireId = null;

    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }

    public function livewireId(string $id): void
    {
        $this->livewireId = $id;
    }

    public function __construct(
        public string $title
    ) {
        $this->buttonSave = Button::make($this->caption, $this->type, $this->action)->icon('s-check');

    }

    public static function make(string $title = ''): Form
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function model(null|Model|array $record = null): void
    {
        $this->model = $record;
        $this->initDatasFormOnMount($record)
            ->initSelectUsing();
    }

    protected function initSelectUsing(): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field instanceof Select) {
                if ($field->optionsUsing()) {
                    $this->addToListOptionsUsing($field->getWireName(), $field->optionsUsing());
                }
                if ($field->searchResultsUsing()) {
                    $this->addToSearchResultsUsing($field->getWireName(), $field->searchResultsUsing());
                }
                if ($field->selectOptionLabelUsing()) {
                    $this->addSelectOptionLabelsUsing($field->getWireName(), $field->selectOptionLabelUsing());
                    if ( ! $field->isMultiple()) {
                        $field->setDefaultLabelForSelect($this);
                    }
                }
            }
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function title(string $title): Form
    {
        $this->title = $title;

        return $this;
    }

    public function init(): void
    {
        if ($this->model && $this->model->exists()) {
            $this->mode = 'UPDATED_RECORD';
        } else {
            $this->mode = 'CREATED_RECORD';
        }
    }

    public function mode(): ?string
    {
        return $this->mode;
    }

    public function getState(): array
    {
        $datas = [];
        foreach ($this->getFormFields() as $field) {
            $datas[$field->getName()] = $field->getDataRecord();
        }

        return $datas;
    }

    public function getSaveButton(): Button
    {
        return $this->buttonSave;
    }

    public function getCancelButton(): Button
    {
        $this->buttonCancel = Button::make('Annuler', 'link', $this->linkIndex())->icon('s-arrow-uturn-left');

        return $this->buttonCancel;
    }

    public function setButtonSave(Button $button): Form
    {
        $this->buttonSave = $button;

        return $this;
    }

    public function setButtonCancel(Button $button): Form
    {
        $this->buttonCancel = $button;

        return $this;
    }
}
