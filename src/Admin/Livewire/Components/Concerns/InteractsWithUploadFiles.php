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
}
