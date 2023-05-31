<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait InteractWithRules
{
    public function interactWithRules(array $rules): array
    {
        $rules['data.' . $this->name] = $this->rules;

        return $rules;
    }
}
