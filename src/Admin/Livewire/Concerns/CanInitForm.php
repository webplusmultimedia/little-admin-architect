<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanInitForm
{
    protected function buildConfig(): Form
    {
        $this->pageRoute = $this->pageRoute ?? request()->collect('fingerprint')->get('name');

        $pageClass = str($this->pageRoute)
            ->explode('.')
            ->map(fn (string $segment) => str($segment)->studly())
            ->implode('\\');
        /** @var Page $page */
        $page = app($pageClass);

        /** @var Resources $resource */
        $resource = $page::getResource();
        $this->_form = $resource::getFormSchema(Form::make($resource::getModelLabel()));
        $this->_form->setPagesForResource($page);
        if ( ! $this->data) {
            $this->data = $this->_form->fill($this->key);
            $this->_form->livewireId($this->id);
            /* if ( ! $this->data->exists) {
                 $this->_form->applyDefaultValue();
             }*/
        } else {
            $this->_form->configureForm(livewireId: $this->id, resource: $page, model: $this->data);
        }
        $this->formDatas = [
            'form' => $this->_form,
            'title' => $resource::getModelLabel(),
        ];

        return $this->_form;
    }

    protected function getForm(): ?Form
    {
        if ( ! $this->_form) {
            $this->_form = $this->buildConfig();
        }

        return $this->_form;
    }
}
