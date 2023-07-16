<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\Select;

trait hasDynamicDatas
{
    protected bool $dynamicOptions = false;

    public function getDynamicOption(): bool
    {
        return $this->dynamicOptions;
    }

    public function setDynamicOption(bool $dynamiqueOption = true): void
    {
        $this->dynamicOptions = $dynamiqueOption;
    }
}
