<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

abstract class AbstractForm
{
    abstract protected function form(null|Model $model): Form;

    /**
     * @return array<int,Field>
     */
    abstract protected function schema(): array;

    public function setUp(null|Model $model): Form
    {
        $form = $this->form($model);
        $form->schema($this->schema());

        return $form;
    }
}
