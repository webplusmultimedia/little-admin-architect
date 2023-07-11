<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait InteractWithAttributeRules
{
    public function applyAttributesRules(array $rules): array
    {
        $rules[$this->getStatePath()] = $this->getAttributes();

        return $rules;
    }

    protected function getAttributes(): string
    {
        return str($this->getLabel())->lower()->value();
    }
}
