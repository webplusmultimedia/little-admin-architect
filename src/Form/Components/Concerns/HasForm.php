<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait HasForm
{
    protected Form $form;

    protected string $statusForm;

    public function getForm(): Form
    {
        return $this->form;
    }

    public function form(Form $form): void
    {
        $this->form = $form;
    }

    public function getStatusForm(): string
    {
        return $this->statusForm;
    }

    public function setStatusForm(string $statusForm): void
    {
        $this->statusForm = $statusForm;
    }
}
