<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

interface CanGetAttributesRules
{
    public function applyAttributesRules(array $rules): array;
}
