<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait HasTitle
{
    public function getTitle(): string
    {
        return str($this->title)->ucfirst()->value();
    }

    public function getTitleForm(): string
    {
        $statusTitle = str($this->getTitleMode())->append(' : ');
        if (Form::UPDATED === $this->statusForm) {
            if ($updateTitle = $this->pageForResource::getResource()::getRecordTitleAttribute()) {
                return $statusTitle->append($this->getFormFieldByName($updateTitle)?->getState())->value();
            }
        }

        return $statusTitle->value();
    }

    public function getBreadcrumb(): ?string
    {
        if ($updateTitle = $this->pageForResource::getResource()::getRecordTitleAttribute()) {
            return $this->getFormFieldByName($updateTitle)?->getState();
        }

        return null;
    }

    public function getTitleMode(): string
    {
        if (Form::UPDATED === $this->statusForm) {
            return 'Edition';
        }

        return 'Création';
    }

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
