<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns;

use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\UnableToCheckFileExistence;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns\HasFileDirectory;

class ImageColumn extends contracts\AbstractColumn
{
    use HasFileDirectory;

    public function getFileUrl(): ?string
    {
        $file = $this->getPathFile($this->getState());
        if ($storage = $this->getStorageForFile($file)) {
            return $storage->url($file);
        }

        return null;
    }

    private function getStorageForFile(string $file): ?FilesystemAdapter
    {
        /** @var FilesystemAdapter $storage */
        $storage = $this->getDisk();
        try {
            if ( ! $storage->exists($file)) {
                return null;
            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        return $storage;
    }
}
