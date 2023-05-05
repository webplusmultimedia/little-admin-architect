<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Admin\Form\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

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
