<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\FormModal;

trait HasActionFormModal
{
    protected FormModal $actionForm;

    protected function actionModal(FormModal $actionModal): static
    {
        $this->actionForm = $actionModal;

        return $this;
    }

    public function getActionModal(): FormModal
    {
        return $this->actionForm;
    }
}
