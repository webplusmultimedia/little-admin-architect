<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait SelectHasDefaultLabel
{
    protected ?string $defaultLabelForSelect = null;

    public function getLabelDefault(): ?string
    {
        return $this->defaultLabelForSelect;
    }

    public function setDefaultLabelForSelect(): void
    {
        if ($this->hasSelectOptionLabelUsing()) {
            if ($this->hasRelationship()) {
                $this->defaultLabelForSelect = $this->evaluate(closure: $this->selectOptionLabelUsing);
            } else {
                $this->defaultLabelForSelect = $this->evaluate(closure: $this->selectOptionLabelUsing, include: ['id' => $this->getState()]);
            }
        }
    }
}
