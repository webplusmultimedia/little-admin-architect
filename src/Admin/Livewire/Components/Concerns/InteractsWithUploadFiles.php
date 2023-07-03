<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\Concerns;

trait InteractsWithUploadFiles
{
    public function getUploadFileUrls(string $path): ?array
    {
        $this->skipRender();

        return $this->form->getUploadFileUrlsUsing($path);
    }

    public function deleteUploadFile(string $path, string $key): bool
    {
        $this->skipRender();

        return $this->form->deleteUploadFileUsing($path, $key);
    }

    public function reorderUploadFiles(string $path, array $newOrder): array
    {
        $this->skipRender();

        return $this->form->reorderUploadFiles($path, $newOrder);
    }
}
