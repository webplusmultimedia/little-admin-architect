<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Button;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanListOptionsForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchResultsUsingForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanUpdatedDatas;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasSelectOptionLabelUsing;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasState;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractsWithUploadFiles;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithRecord;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasModal;

final class Form implements Htmlable
{
    use CanGetRules;
    use CanInitDatasForm;
    use CanListOptionsForSelect;
    use CanSearchResultsUsingForSelect;
    use CanUpdatedDatas;
    use CanValidatedValues;
    use HasDefaultValue;
    use HasFields;
    use HasGridColumns;
    use HasModal;
    use HasSchema;
    use HasSelectOptionLabelUsing;
    use HasState;
    use InteractsWithUploadFiles;
    use InteractWithLivewire;
    use InteractWithPage;
    use InteractWithRecord;

    protected string $view = 'form';

    protected BaseForm|Component $livewire;

    protected string $eventForCloseModal = 'close.modal';

    /**
     * @var Model|array<string,string>|null
     */
    protected null|Model|array $model = null;

    public const CREATED = 'CREATED';

    public const UPDATED = 'UPDATED';

    protected ?string $statusForm = null;

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

    public function configureForm(Page $resource, Model $model): void
    {
        $this->model($model);
        $this->setPagesForResource($resource);
    }

    public function livewireId(string $id): void
    {
        $this->livewireId = $id;
    }

    public function __construct(
        public string $title = ''
    ) {
        $this->buttonSave = Button::make(trans('little-admin-architect::form.button.save'), $this->type, $this->action)->icon('heroicon-s-check');

    }

    public static function make(string $title = ''): Form
    {
        return new self(title: $title);
    }

    public function getView(): string
    {
        return 'little-views::form-components.' . $this->view;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function model(Model $record): void
    {

        if ( ! $this->model) {
            $this->model = $record;
            $this->initMode();
            $this->initDatasFormOnMount($this->model);
            $this->removeHiddenFieldsOnForm();
            $this->initSelectUsing();
        }
    }

    public function modelArray(array $record): void
    {
        $this->model = $record;
        $this->statusForm = 'CREATED';
        $this->initDatasFormOnMount($record);
        $this->initSelectUsing();
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

    public function initMode(): void
    {
        if ($this->model instanceof Model and $this->model->exists) {
            $this->statusForm = self::UPDATED;
        } else {
            $this->statusForm = self::CREATED;
        }
    }

    public function getStatusForm(): ?string
    {
        return $this->statusForm;
    }

    public function getSaveButton(): Button
    {
        return $this->buttonSave;
    }

    public function getCancelButton(): Button
    {
        $this->buttonCancel = Button::make(trans('little-admin-architect::form.button.cancel'), 'link', $this->linkIndex())->icon('heroicon-s-arrow-uturn-left');

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

    public function getRecord(): Model|array|null
    {
        return $this->model;
    }

    public function livewireComponent(Component $livewire): Form
    {
        $this->livewire = $livewire;

        return $this;
    }

    protected function getLivewireComponent(): Component
    {
        return $this->livewire;
    }

    protected function render(): View
    {
        return view($this->getView(), ['form' => $this]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
