<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Form extends Component
{
    protected string $view = 'form';

    public function __construct(
        protected \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form $form,
        public string $method = 'GET',
        public array|object|null $bind = null,
    ) {
        if ($this->form->hasModal()) {
            $this->view = 'form-modal';
        }
    }

    public function getForm(): \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form
    {
        return $this->form;
    }

    protected function getView()
    {
        return 'little-views::form-components.' . $this->view;
    }

    public function render(): View
    {
        return view($this->getView());
    }

    public function getTitleForm(): mixed
    {
        if ($this->form->getResourcePage() and $title = $this->form->getResourcePage()::getRecordTitleAttribute()) {
            $record = $this->form->getRecord();
            if ($record->exists) {
                return __('little-admin-architect::form.edit.title', ['title' => $record->{$title}]);
            }

            return __('little-admin-architect::form.create.title', ['title' => $this->form->title]);
        }

        return null;
    }
}
