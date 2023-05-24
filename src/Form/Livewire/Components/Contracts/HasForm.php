<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

interface HasForm
{

    public function getOptionUsing(string $name): array;
    public function getSearchResultUsing(string $name, string $term): array;


}
