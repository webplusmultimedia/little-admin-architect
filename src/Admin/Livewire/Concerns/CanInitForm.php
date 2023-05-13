<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

trait CanInitForm
{
    protected function buildConfig(): array
    {
        $route_name = $this->routeName ?? request()->route()->getName();
        // dump($route_name);
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
        //dump($this->data->toArray(),$this->datasRules);

        return [
            'form' => $this->_form,
            'title' => $resource::getModelLabel(),
        ];
    }
}
