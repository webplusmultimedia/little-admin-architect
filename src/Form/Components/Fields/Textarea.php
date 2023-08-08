<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

final class Textarea extends Field
{
    protected string $view = 'textarea';

    protected string $colSpan = 'lg:col-span-full';

    protected int $rows = 6;

    public function setUp(): void
    {
        $this->setViewDatas('field', $this);
    }
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
