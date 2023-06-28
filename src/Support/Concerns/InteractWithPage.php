<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resource;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait InteractWithPage
{
    protected Page $pageForResource;

    protected ?Form $form = null;

    public function setPagesForResource(Page $page): void
    {
        $this->pageForResource = $page;
    }

    public function setLivewireComponent(BaseForm $livewire): void
    {
        $this->livewire = $livewire;
        $this->livewireId($livewire->id);
    }

    public function getResourcePage(): Resource|string|null
    {
        return $this->pageForResource::getResource();
    }

    public function linkEdit(Model $record): string
    {
        return $this->pageForResource::getEditUrl($record);
    }

    public function linkCreate(): string
    {
        return $this->pageForResource::getCreateUrl();
    }

    public function linkIndex(): string
    {
        return $this->pageForResource::getListUrl();
    }

    public function hasModalForm(): bool
    {
        if ( ! $this->form) {
            $this->form = $this->pageForResource::getForm();
        }

        return $this->form->hasModal();
    }

    public function getPage(): Page
    {
        return $this->pageForResource;
    }
}
