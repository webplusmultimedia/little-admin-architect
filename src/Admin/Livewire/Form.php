<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form as LittleFormAlias;

class Form extends Component implements Htmlable
{

    public ?Model $data = NULL;
    public null|string $config = NULL;
    public bool $initialized = true;
    public bool $init = true;
    protected LittleFormAlias|null $_form = NULL;
    protected array $datasRules;
    protected array $attributesRules;
    protected array $configParams = [];


    public function mount($data)
    {
         $this->data = $data;
    }
    protected function rules(): array
    {
        return $this->datasRules;
    }

    public function booted()
    {
       $this->formDatas = $this->buildConfig();
    }

    protected function buildConfig(): array
    {


        //dump($this->config);
        /** @var Page $page */
        $page = app($this->config);

        /** @var Resources $resource */
        $resource = $page::getResource();
        $this->_form = $resource::getForm();

        $this->_form->livewireId($this->id);
        $this->_form->bind($this->data);
        $this->_form->title($resource::getModelLabel());


        $this->datasRules = $this->_form->getRules();
        $this->attributesRules = $this->_form->getAttributesRules();
        return [
            'form' => $this->_form,
            'title' => $resource::getModelLabel()
        ];
    }

    public function init()
    {
        $this->initialized = true;
    }
    public function render():View
    {

        return view('little-views::livewire.form', $this->formDatas);
    }
    public function updated($name, $value)
    {
        $this->validateOnly(field: $name, attributes: $this->attributesRules);
    }

    public function save()
    {
         $this->_form->saveDatasForm($this);
        //@todo Emit message Save

    }

    public function toHtml()
    {
        $this->render()->render();
    }
}
