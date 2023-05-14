<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

trait CanInitForm
{
    protected function buildConfig(): array
    {
         $this->pageRoute =  $this->pageRoute ?? request()->collect('fingerprint')->get('name');

         $pageClass = str($this->pageRoute)
             ->explode('.')
             ->map(fn(string $segment) => str($segment)->studly())
             ->implode('\\') ;
        /** @var Page $page */
        $page = app($pageClass);

        /** @var Resources $resource */
        $resource = $page::getResource();
        $this->_form = $resource::getFormSchema(Form::make($resource::getModelLabel()));

        $this->_form->livewireId($this->id);
        $this->_form->bind($this->data);
        //$this->_form->title($resource::getModelLabel());

        $this->datasRules = $this->_form->getRules();
        $this->attributesRules = $this->_form->getAttributesRules();

        return [
            'form' => $this->_form,
            'title' => $resource::getModelLabel(),
        ];
    }
}
