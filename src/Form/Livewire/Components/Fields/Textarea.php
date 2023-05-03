<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

final class Textarea extends Field
{
    protected string $view = 'form::textarea';
    protected int $rows = 6;
    public function rows(int $rows): Textarea
    {
        $this->rows = $rows;
        return $this;
    }

    public function getRows(): int
    {
        return $this->rows;
    }
}
