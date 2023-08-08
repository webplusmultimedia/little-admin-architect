<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

use Illuminate\Contracts\Support\Htmlable;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\TableModal;

trait HasModal
{
    protected bool $isModal = false;

    protected ?string $modalTitle = null;

    protected ?TableModal $modal = null;

    protected string|Htmlable|null $content = null;

    public function getModal(): ?TableModal
    {
        return $this->modal;
    }

    public function modal(TableModal $modal): static
    {
        $this->modal = $modal;

        return $this;
    }

    public function setIsModal(bool $isModal = true): static
    {
        $this->isModal = $isModal;

        return $this;
    }
}
