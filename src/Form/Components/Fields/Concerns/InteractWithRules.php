<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait InteractWithRules
{
    public function dehydrateRules(array $rules): array
    {
        $rules['data.' . $this->getName()] = $this->rules;

        return $rules;
    }

    public function hydrateRules(array $rules): array
    {
        $rules['data.' . $this->getName()] = $this->rules;

        return $rules;
    }

    public function beforeSaveRulesUsing(array $rules): array
    {
        $rules['data.' . $this->getName()] = $this->rules;

        return $rules;
    }
}
