<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait CanBeBoolean
{
    /** Accepted input are true, false, 1, 0, "1", and "0" */
    public function boolean(): static
    {
        $this->addRules('boolean');

        return $this;
    }
}
