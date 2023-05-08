<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Admin\Form\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

trait HasSetUpForm
{
    public function setUp(null|Model $model): Form
    {
        $form = $this->form($model);
        $form->schema($this->schema());

        return $form;
    }
}
