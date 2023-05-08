<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

interface CanGetAttributesRules
{
    public function applyAttributesRules(array $rules): array;
}
