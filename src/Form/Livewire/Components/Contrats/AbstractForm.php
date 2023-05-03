<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractForm
{
    abstract protected function form(null|Model $model):Form;
    abstract protected function schema():array;

    public function setUp(null|Model $model):Form
    {
        $form = $this->form($model);
        $form->schema($this->schema());
        return $form;
    }
}
