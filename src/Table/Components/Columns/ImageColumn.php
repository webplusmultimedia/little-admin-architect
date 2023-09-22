<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Storage;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasFileDirectory;

class ImageColumn extends contracts\AbstractColumn
{
    use HasFileDirectory;

    protected string $view = 'image';

    public function getFileUrl(): ?string
    {
        /** @var null|array $state */
        $state = $this->getState();

        if ( ! blank($state)) {
            $_file = $state[0]['file'];

            if (Storage::disk($this->getDiskName())->exists($this->getPathFile($_file))) {
                return Storage::disk($this->getDiskName())->url($this->getPathFile($_file));
            }
        }

        return null;
    }

    public function getUrlForCroppa(): null|UrlGenerator|string
    {
        /** @var null|array $state */
        $state = $this->getState();

        if ( ! blank($state)) {
            $_file = $state[0]['file'];
            if (Storage::disk($this->getDiskName())->exists($this->getPathFile($_file))) {
                return $this->getUrl($this->getPathFile($_file), 60, 50);
            }
        }

        return null;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->sortable(false);
        $this->setSearch(null);
        $this->baseDirectory = config('little-admin-architect.attachments.root-path');
    }
}
