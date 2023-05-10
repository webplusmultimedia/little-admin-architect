<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages\EditRecord;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form as LittleFormAlias;

class Form extends Component
{
    public ?Model $data = NULL;
    public null|string $config = NULL;
    public bool $init = true;
    protected LittleFormAlias|null $_form = NULL;
    protected array $datasRules;
    protected array $attributesRules;
    protected array $configParams = [];
    protected array $formVal = [];

    protected function rules(): array
    {
        return $this->datasRules;
    }

    public function booted()
    {

        /** @todo get resource by url : put url in manager */
        try {
            $id = (int) str(request()->path())->beforeLast('/')->afterLast('/')->value();

//            if($path = str(request()->segment(3))){
//                /** @var EditRecord $basename */
//                $basename= str($path)->explode('.')->map(fn($val)=>str($val)->studly())->implode('\\');
//                /** @var Resources $resource */
//                $resource = $basename::getResource();
//                $this->_form = $resource::getForm();
//                $this->_form->bind($this->data);
//
//                //dump($resource::getEloquentQuery()->first());
//            }
            $this->formVal = $this->buildConfig();
        }catch (Exception){
            abort(404);
        }

    }
    protected function buildConfig(): array
    {
        $this->_form ??= app($this->config)->setUp($this->data);
        $this->_form->livewireId($this->id);

        $this->datasRules = $this->_form->getRules();
        $this->attributesRules = $this->_form->getAttributesRules();
        if (!$this->data){
            $this->data = $this->_form->getBind();
        }
        return [
            'form' => $this->_form,
        ];
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('little-views::livewire.form', $this->formVal);
    }
    public function updated($name, $value)
    {
        $this->validateOnly(field: $name, attributes: $this->attributesRules);
    }

    public function save()
    {
        $datas = $this->_form->values($this->validate(rules: $this->rules(), attributes: $this->attributesRules));
        // dd($datas);
        if (! $this->data?->exists) {
            $this->data?->fill($datas)->save();
        } else {
            $this->data->update($datas);
        }
    }

}
