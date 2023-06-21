<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasFileDirectory;

class FileUpload extends Field
{
    use HasFileDirectory;

    protected string $view = 'file-upload-field';

    /**
     * @return Closure|null
     */
    public function hydrateState(): mixed
    {
        if (blank($this->getState())) {
            $this->state([]);
        }

        return null;
    }
}
