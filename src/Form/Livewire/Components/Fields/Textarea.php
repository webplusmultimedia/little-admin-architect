<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

final class Textarea extends Field
{
    protected string $view = 'textarea';

    protected int|string $colSpan = 'col-span-full';

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
