<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Contracts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

interface AbilityToCreateLivewireForm
{
    public function form(?Model $model): Form;

    public function schema(): array;

    public function setUp(?Model $model): Form;
}
