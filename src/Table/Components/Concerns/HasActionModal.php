<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\Modal;

trait HasActionModal
{
    protected Modal $actionModal;

    public function actionModal(Modal $modal): static
    {
        $this->actionModal = $modal;

        return $this;
    }

    public function getActionModal(): Modal
    {
        return $this->actionModal;
    }
}
