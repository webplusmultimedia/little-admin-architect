<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns\CanInitForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns\InteractsWithForms;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\HasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form as LittleFormAlias;

/**
 * @property LittleFormAlias $form
 */
class ComponentForm extends Component implements HasForm
{
    use CanInitForm;
    use InteractsWithForms;

    public ?Model $data = null;

    public bool $initialized = false;

    public ?string $previousPage = null;

    public function mount(?Model $data, ?string $pageRoute): void
    {
        $this->previousPage = url()->previous();
        $this->routeName = request()->route()->getName();
        $this->pageRoute = $pageRoute;
        $this->data = $data;
        $this->getForm();
        if ( ! $data?->exists) {
            $this->form->applyDefaultValue();
        }
        /*$this->datasRules = $this->form->getFormRules();
        $this->attributesRules = $this->_form->getAttributesRules();*/

        $this->data = $data;
        $this->initialized = true;
        $this->initBoot = false;
        // dump($this->getOptionsUsing('data.categorie_id'),$this->getSearchResultsUsing('data.categorie_id','2'));

    }

    protected function rules(): array
    {
        return $this->form->getFormRules();
    }

   /* public function booted(): void
    {
        if ($this->initBoot) {
            $this->formDatas = $this->buildConfig();
        }
    }*/

    public function init(): void
    {
        $this->initialized = true;
    }

//    public function updated(string $name, mixed $value): void
//    {
//       /* $validator = Validator::make(data:[$name => $value],rules: $this->getRules(),attributes: $this->attributesRules);
//        if ($validator->fails()){
//            $this->addError($name,$validator->getMessageBag()->first());
//        }*/
//
//
//        //$this->validate(rules: $this->getRules(), attributes: $this->attributesRules);
//        $this->validateOnly(field: $name, attributes: $this->attributesRules);
//    }

    public function save(): void
    {
        //dump($this->datasRules);
        $this->form->saveDatasForm($this);
        session()->flash('message', 'Post successfully updated.');
        //@todo Emit Event Notification message Save

    }
}
