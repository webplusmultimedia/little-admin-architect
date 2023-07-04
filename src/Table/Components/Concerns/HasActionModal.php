<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Support\Components\BaseModal;

trait HasActionModal
{
    protected BaseModal $actionModal;

    protected function actionModal(BaseModal $modal): static
    {
        $this->actionModal = $modal;

        return $this;
    }

    public function getActionModal(): BaseModal
    {
        return $this->actionModal;
    }
}
