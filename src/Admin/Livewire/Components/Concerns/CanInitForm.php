<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages\CreateRecord;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Pages\EditRecord;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanInitForm
{
    protected function buildConfig(): Form
    {
        $page = $this->getResourcePage();

        /** @var Resources\Resource $resource */
        $resource = $page::getResource();
        $this->_form = $resource::getFormSchema(Form::make($resource::getModelLabel()));
        $this->_form->translatedLang($this->selectedLangue);
        $this->_form->setPagesForResource($page);
        $this->_form->setLivewireComponent($this);
        if ( ! $this->data) {
            $this->data = $this->_form->fill($this->key);
        }
        $this->_form->configureForm(resource: $page, model: $this->data);

        $this->formDatas = [
            'form' => $this->_form,
            'title' => $resource::getModelLabel(),
        ];

        return $this->_form;
    }

    protected function getResourcePage(): EditRecord|CreateRecord
    {
        //$this->pageRoute = $this->pageRoute ?? request()->collect('fingerprint')->get('name');

        $pageClass = str($this->pageRoute)
            ->explode('.')
            ->map(fn (string $segment) => str($segment)->studly())
            ->implode('\\');

        return app($pageClass);
    }

    public function getTitleForm(): string
    {
        return $this->_form->getTitle();
    }

    public function getForm(): ?Form
    {
        if ( ! $this->_form) {
            $this->_form = $this->buildConfig();
        }

        return $this->_form;
    }
}
