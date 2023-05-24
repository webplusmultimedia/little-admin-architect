<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts;

interface CanInteractWithRules
{
    public function interactWithRules(array $rules): array;
}
