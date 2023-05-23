<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns\CanInitForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form as LittleFormAlias;

/**
 * @property ?Model $data
 */
class ComponentForm extends Component
{
    use CanInitForm;

    public ?Model $data = null;

    public bool $initialized = false;

    public ?string $previousPage = null;

    protected null|string $pageRoute = null;

    protected ?string $routeName = null;

    protected bool $initBoot = true;

    protected LittleFormAlias|null $_form = null;

    protected array $datasRules;

    protected array $attributesRules;

    protected array $configParams = [];

    protected array $formDatas = [];

    public function mount(?Model $data, ?string $pageRoute): void
    {
        $this->previousPage = url()->previous();
        $this->routeName = request()->route()->getName();
        $this->pageRoute = $pageRoute;
        $this->data = $data;
        $this->formDatas = $this->buildConfig();
        if ( ! $data?->exists) {
            $this->_form->applyDefaultValue();
        }
        $this->datasRules = $this->_form->getRules();
        $this->attributesRules = $this->_form->getAttributesRules();

        $this->data = $data;
        $this->initialized = true;
        $this->initBoot = false;
        // dump($this->getOptionsUsing('data.categorie_id'),$this->getSearchResultsUsing('data.categorie_id','2'));

    }

    protected function rules(): array
    {
        return $this->datasRules;
    }

    public function booted(): void
    {
        if ($this->initBoot) {
            $this->formDatas = $this->buildConfig();
        }
    }

    public function getOptionUsing(string $name): array
    {
       $results =  $this->getOptionsUsing($name);
       $options = [];
       if ($results instanceof Collection){
           return $results->map(fn($value,$key) => ['value'=>$key,'label'=>$value])->values()->toArray();
       }
       return $options;
    }

    public function getSearchResultUsing(string $name, string $term): array
    {
        $results = $this->getSearchResultsUsing($name,$term);
        $options = [];
        if ($results instanceof Collection){
            return $results->map(fn($value,$key) => ['value'=>$key,'label'=>$value])->values()->toArray();
        }
        return $options;
    }

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
        $this->_form->saveDatasForm($this);
        session()->flash('message', 'Post successfully updated.');
        //@todo Emit message Save

    }
}
