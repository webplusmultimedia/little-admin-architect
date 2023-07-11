<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait HasSetUpForm
{
    public function setUp(?Model $model): Form
    {
        $form = $this->form($model);
        $form->schema($this->schema());

        return $form;
    }
}
