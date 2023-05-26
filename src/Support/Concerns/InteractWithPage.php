<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;

trait InteractWithPage
{
    protected Page $pageForResource;

    protected function setPagesForResource(Page $page): void
    {
        $this->pageForResource = $page;
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
}
