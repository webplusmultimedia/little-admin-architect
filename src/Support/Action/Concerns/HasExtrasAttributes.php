<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

trait HasExtrasAttributes
{
    protected ?string $extraAttributes = null;

    public function extraAttributes(string $extraAttributes): HasExtrasAttributes
    {
        $this->extraAttributes = $extraAttributes;

        return $this;
    }
}
