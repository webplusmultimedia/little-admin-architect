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
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasActionFormModal;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasFormFieldsAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasHeaderAction;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasTranslatedField;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FileUpload;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithRecord;
use Webplusmultimedia\LittleAdminArchitect\Support\Form\Contracts\BaseForm as BaseFormAlias;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns\HasModal;

final class Form extends BaseFormAlias implements Htmlable
{
    use HasActionFormModal;
    use HasFormFieldsAction;
    use HasHeaderAction;
    use HasModal;
    use InteractWithLivewire;
    use InteractWithRecord;
    use HasTranslatedField;

    protected string $view = 'form';

    protected string $eventForCloseModal = 'close.modal';

    public const CREATED = 'CREATED';

    public const UPDATED = 'UPDATED';

    public function getLivewireId(): ?string
    {
        return $this->livewireId;
    }

    public function setLivewireComponent(BaseForm $livewire): void
    {
        $this->livewire = $livewire;
        $this->livewireId($livewire->id);
    }

    public function configureForm(Page $resource, Model $model): void
    {

        $this->model = $model;
        $this->initMode();
        $this->initDatasFormOnMount($this->model);
        $this->setUpFieldsOnForm();
        $this->hydrateState();
        if (self::CREATED === $this->statusForm) {
            $this->applyDefaultValue();
        }

        $this->setPagesForResource($resource);
        $this->headerActions($this->pageForResource::getActions());
        $this->actionModal(FormModal::make($this->livewireId . '-action-form'));

    }

    public function livewireId(string $id): void
    {
        $this->livewireId = $id;
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

    public function modelArray(array $record, Component $livewire): void
    {
        $this->model = $record;
        $this->statusForm = 'CREATED';
        $this->livewire = $livewire; //@phpstan-ignore-line
        $this->initDatasFormOnMount($record);
        $this->setUpFieldsOnForm(false);
    }

    public function initMode(): void
    {
        if ($this->model instanceof Model and $this->model->exists) {
            $this->statusForm = self::UPDATED;
        } else {
            $this->statusForm = self::CREATED;
        }
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

    public function reorderUploadFiles(string $path, array $newOrder): array
    {
        /** @var ?FileUpload $field */
        $field = $this->getFormFieldByPath($path);
        if ($field) {
            return $field->reorder($newOrder);
        }

        return [];
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
