<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Illuminate\Contracts\Support\Htmlable;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\Modal;

trait HasModal
{
    protected bool $isModal = false;

    protected ?string $modalTitle = null;

    protected ?Modal $modal = null;

    protected string|Htmlable|null $content = null;

    public function getModal(): ?Modal
    {
        return $this->modal;
    }

    public function modal(Modal $modal): static
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
