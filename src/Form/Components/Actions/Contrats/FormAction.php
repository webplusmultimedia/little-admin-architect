<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Contrats;

use Webplusmultimedia\LittleAdminArchitect\Support\Action\Contracts\Action;

abstract class FormAction extends Action
{
    protected string $livewireData = 'mountFormActionData';

    protected function getLivewireData(string $name): mixed
    {
        $path = $this->livewireData . '.' . $name;

        return data_get($this->livewire, $path, null);
    }
}
