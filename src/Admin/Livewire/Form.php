<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form as LittleFormAlias;

class Form extends Component implements Htmlable
{
    public ?Model $data = null;

    public null|string $config = null;

    public bool $initialized = true;

    public bool $init = true;

    public ?string $routeName = null;

    protected LittleFormAlias|null $_form = null;

    protected array $datasRules;

    protected array $attributesRules;

    protected array $configParams = [];

    protected array $formDatas = [];

    public function mount(?Model $data): void
    {
        $this->data = $data;
        $this->routeName = request()->route()->getName();
    }

    protected function rules(): array
    {
        return $this->datasRules;
    }

    public function booted(): void
    {
        $this->formDatas = $this->buildConfig();
    }

    protected function buildConfig(): array
    {
        $route_name = $this->routeName ?? request()->route()->getName();
        //dump($route_name);
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
            'title' => $resource::getModelLabel(),
        ];
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
