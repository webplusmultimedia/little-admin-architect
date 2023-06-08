<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\BaseModal;

class Modal extends BaseModal implements Htmlable
{
    public function __construct(
        public string $id,
    ) {

    }

    public static function make(string $id): Modal
    {
        return new self($id);
    }

    public function render(): View
    {
        return view('little-views::modal.modal', ['id' => $this->id, 'maxWidth' => $this->getMaxWidth(), 'content' => $this->content]);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
