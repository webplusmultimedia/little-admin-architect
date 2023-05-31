<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

abstract class AbstractForm
{
    use HasSetUpForm;

    abstract protected function form(null|Model $model): Form;

    /**
     * @return array<int,Field|AbstractLayout>
     */
    abstract protected function schema(): array;

    abstract public function setUp(null|Model $model): Form;
}
