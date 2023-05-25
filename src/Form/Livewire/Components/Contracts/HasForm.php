<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts;

interface HasForm
{
    public function getOptionUsing(string $name): array;

    public function getSearchResultUsing(string $name, string $term): array;
}
