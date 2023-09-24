<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait InteractWithRules
{
    public function dehydrateRules(array $rules): array
    {
        if ($this->checkRelation()) {
            $rules[$this->getStatePath()] = $this->rules;
        } else {
            $rules[$this->getStatePath()] = $this->rules;
        }

        return $rules;
    }

    public function hydrateRules(array $rules): array
    {
        if ($this->checkRelation()) {
            $rules[$this->getStatePath()] = $this->rules;
        } else {
            // $rules['data.' . $this->getName()] = $this->rules;
            $rules[$this->getStatePath()] = $this->rules;
        }

        return $rules;
    }

    public function beforeSaveRulesUsing(array $rules): array
    {
        $rules[$this->getStatePath()] = $this->rules;

        return $rules;
    }
}
