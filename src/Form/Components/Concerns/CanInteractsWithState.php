<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait CanInteractsWithState
{
    public function get(string $name): mixed
    {
        return $this->getDataRecordByName($name);
    }

    public function set(string $name, mixed $value): void
    {
        $this->setDataToRecordByName($name, $value);
    }
}
