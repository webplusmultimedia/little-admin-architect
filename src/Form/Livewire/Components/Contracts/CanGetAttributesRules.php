<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts;

interface CanGetAttributesRules
{
    public function applyAttributesRules(array $rules): array;
}
