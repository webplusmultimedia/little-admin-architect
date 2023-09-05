<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

trait CanAlignText
{
    protected string $textAlign = 'text-left';

    public function center(): static
    {
        $this->textAlign = 'text-center';

        return $this;
    }

    public function right(): static
    {
        $this->textAlign = 'text-right';

        return $this;
    }

    public function getTextAlign(): string
    {
        return $this->textAlign;
    }
}
