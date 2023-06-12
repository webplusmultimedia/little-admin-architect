<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\CanInitForm;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns\HasNotification;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractsWithForms;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\HasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form as LittleFormAlias;

/**
 * @property LittleFormAlias $form
 */
class BaseForm extends Component implements HasForm
{
    use CanInitForm;
    use HasNotification;
    use InteractsWithForms;

    public ?Model $data = null;

    public bool $initialized = false;

    public ?string $previousPage = null;

    protected mixed $key = null;

    public function mount(mixed $key, ?string $pageRoute): void
    {
        $this->previousPage = url()->previous();
        $this->pageRoute = $pageRoute;
        $this->key = $key;

        $this->getForm();
        /*if ( ! $this->data?->exists) {
            $this->form->applyDefaultValue();
        }*/

        $this->initialized = true;
        $this->initBoot = false;
        // dump($this->getOptionsUsing('data.categorie_id'),$this->getSearchResultsUsing('data.categorie_id','2'));

    }

    protected function rules(): array
    {
        return $this->form->getFormRules();
    }

    public function init(): void
    {
        $this->initialized = true;
    }

    public function save(): void
    {
        $this->form->saveDatasForm();
    }

    public function dehydrate(): void
    {
        $this->form->getState();
    }
}
