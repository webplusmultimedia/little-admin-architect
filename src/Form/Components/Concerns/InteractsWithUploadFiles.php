<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait InteractsWithUploadFiles
{
    public function getUploadFileUrlsUsing(string $path): false|array
    {
        $field = $this->getFormFieldByPath($path);
        if ( ! $field or ! method_exists($field, 'getUploadFileUrlsUsing')) {
            return false;
        }

        return $field->getUploadFileUrlsUsing();
    }
}
