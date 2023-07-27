<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components;

use Illuminate\View\View;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\BaseModal;

class FormModal extends BaseModal
{
    public function __construct(
        public string $id,
    ) {
        $this->alpineData = "ModalFormComponent('{$id}')";
        $this->formAction = 'CallMountFormAction';
        $this->actionData = 'mountFormActionData';
        $this->alpineCloseModal = 'isOpen = false;$wire.closeMountFormAction()';
    }

    public static function make(string $id): FormModal
    {
        return new self($id);
    }

    public function render(): View
    {
        return view(
            'little-views::modal.modal',
            [
                'id' => $this->id,
                'maxWidth' => $this->getMaxWidth(),
                'content' => $this->content,
                'formAction' => $this->formAction,
                'alpineData' => $this->alpineData,
                'actionData' => $this->actionData,
                'alpineCloseModal' => $this->alpineCloseModal,
            ]
        );
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
