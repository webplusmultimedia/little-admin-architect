<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait InteractsWithUploadFiles
{
    public function getUploadFileUrlsUsing(string $path): ?array
    {
        $field = $this->getFormFieldByPath($path);
        if ( ! $field or ! method_exists($field, 'getUploadFileUrlsUsing')) {
            return null;
        }

        return $field->getUploadFileUrlsUsing();
    }
}
