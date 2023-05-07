<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Admin\Form\Contracts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

interface AbilityToCreateLivewireForm
{
    public function form(null|Model $model): Form;

    public function schema(): array;

    public function setUp(null|Model $model): Form;
}
