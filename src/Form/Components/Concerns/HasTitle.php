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
        $statusTitle = str('Nouveau ')->append('(', $this->getTitle(), ') : ');
        if (Form::UPDATED === $this->statusForm) {
            $statusTitle = str('Edition ')->append('(', $this->getTitle(), ') : ');
            if ($updateTitle = $this->pageForResource::getResource()::getRecordTitleAttribute()) {
                return $statusTitle->append($this->getFormFieldByName($updateTitle)?->getState())->value();
            }
        }

        return $statusTitle->value();
    }

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
