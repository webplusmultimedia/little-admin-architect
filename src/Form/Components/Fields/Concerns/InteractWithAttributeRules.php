<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait InteractWithAttributeRules
{
    public function applyAttributesRules(array $rules): array
    {
        $rules['data.' . $this->name] = str($this->getLabel())->lower();

        return $rules;
    }
}
