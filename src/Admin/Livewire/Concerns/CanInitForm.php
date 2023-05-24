<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

trait CanInitForm
{
    protected function buildConfig(): Form
    {
        $this->pageRoute = $this->pageRoute ?? request()->collect('fingerprint')->get('name');

        $pageClass = str($this->pageRoute)
            ->explode('.')
            ->map(fn(string $segment) => str($segment)->studly())
            ->implode('\\');
        /** @var Page $page */
        $page = app($pageClass);

        /** @var Resources $resource */
        $resource = $page::getResource();
        $this->_form = $resource::getFormSchema(Form::make($resource::getModelLabel()));

        $this->_form->livewireId($this->id);
        $this->_form->model($this->data);
        $this->_form->setPagesForResource($page);

        $this->datasRules = $this->_form->getFormRules();
        $this->attributesRules = $this->_form->getAttributesRules();
        //dump($this->data,$this->datasRules );
        // $this->resetErrorBag();
        $this->formDatas = [
            'form'  => $this->_form,
            'title' => $resource::getModelLabel(),
        ];
         return $this->_form;
    }

    protected function getForm(): ?Form
    {
        if(!$this->_form){
          $this->_form =   $this->buildConfig();
        }
        return $this->_form;
    }
}
