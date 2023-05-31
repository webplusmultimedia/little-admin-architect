<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Contracts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

interface AbilityToCreateLivewireForm
{
    public function form(null|Model $model): Form;

    public function schema(): array;

    public function setUp(null|Model $model): Form;
}
