<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns\CanInitForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form as LittleFormAlias;

class Form extends Component implements Htmlable
{
    use CanInitForm;
    public ?Model $data = null;

    public null|string $config = null;

    public bool $initialized = false;

    public bool $init = true;

    public ?string $routeName = null;

    protected LittleFormAlias|null $_form = null;

    protected array $datasRules;

    protected array $attributesRules;

    protected array $configParams = [];

    protected array $formDatas = [];

    public function mount(?Model $data): void
    {
        $this->routeName = request()->route()->getName();
        $this->formDatas = $this->buildConfig();
        $this->_form->initDatasFormOnMount($data);
        $this->_form->applyDefaultValue($data);
        $this->data = $data;
        $this->initialized = true;
    }

    protected function rules(): array
    {
        return $this->datasRules;
    }

    public function booted(): void
    {
        if ($this->initialized) {
            $this->formDatas = $this->buildConfig();
        }
    }

    public function hydrate()
    {

    }



    public function init(): void
    {
        $this->initialized = true;
    }

    public function render(): View
    {

        return view('little-views::livewire.form', $this->formDatas);
    }

    public function updated($name, $value): void
    {
        //dd($name,$value,$this->getRules());
        $this->validateOnly(field: $name, attributes: $this->attributesRules);
    }

    public function save(): void
    {
        $this->_form->saveDatasForm($this);
        //@todo Emit message Save

    }

    public function toHtml(): void
    {
        $this->render()->render();
    }
}
