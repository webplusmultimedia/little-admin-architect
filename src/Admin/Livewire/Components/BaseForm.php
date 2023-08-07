<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Exception;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\CanInitForm;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\HasMountFormAction;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\HasNotification;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\InteractsWithForms;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\InteractsWithUploadFiles;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\HasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form as LittleFormAlias;

/**
 * @property LittleFormAlias $form
 */
class BaseForm extends Component implements HasForm
{
    use CanInitForm;
    use HasMountFormAction;
    use HasNotification;
    use InteractsWithForms;
    use InteractsWithUploadFiles;
    use WithFileUploads;

    public ?Model $data = null;

    public array $record = [];

    public bool $initialized = false;

    public ?string $previousPage = null;

    protected mixed $key = null;

    public function mount(mixed $key, ?string $pageRoute): void
    {

        //@Todo : Can update or edit
        $this->previousPage = url()->previous();
        $this->pageRoute = $pageRoute;
        $this->key = $key;
        $this->form->authorizeAccess();
        //$this->form->hydrateState();
        $this->record = [];

        $this->initialized = true;
        $this->initBoot = false;

    }

    protected function rules(): array
    {
        return $this->form->getFormsRules();
    }

    public function init(): void
    {
        $this->initialized = true;
    }

    public function save(): void
    {
        $this->form->saveDatasForm();
    }

    public function callAction(string $component, string $actionName, array $arguments = [], bool $skipRender = false): mixed
    {
        if ($skipRender) {
            $this->skipRender();
        }
        $componentField = $this->form->getFormFieldByPath($component);
        if ($componentField) {
            return $componentField->callActionResult(action: $actionName, arguments: $arguments);
        }
        throw new Exception("This Component [{$component}] doesn't exist");
    }

    public function updated(string $name, mixed $value): void
    {
        $this->form->updated(name: $name, value: $value);
    }
}
