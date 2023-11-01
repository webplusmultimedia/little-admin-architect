<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components;

use Webplusmultimedia\LittleAdminArchitect\Support\Components\BaseModal;

class TableModal extends BaseModal
{
    public function __construct(
        public string $id,
    ) {
        $this->alpineData = "ModalTableComponent('{$id}')";
        $this->formAction = 'CallMountTableAction';
        $this->actionData = 'mountTableActionRecord';
        $this->alpineCloseModal = 'isOpen = false;$wire.closeMountTableAction()';
    }

    public static function make(string $id): TableModal
    {
        return new self($id);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
