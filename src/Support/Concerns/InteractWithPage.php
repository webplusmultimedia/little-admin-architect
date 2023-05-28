<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

trait InteractWithPage
{
    protected Page $pageForResource;

    public function setPagesForResource(Page $page): void
    {
        $this->pageForResource = $page;
    }

    public function getResourcePage(): Resources|string|null
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
        return $this->pageForResource::getForm()->hasModal();
    }

    public function getPage(): Page
    {
        return $this->pageForResource;
    }
}
