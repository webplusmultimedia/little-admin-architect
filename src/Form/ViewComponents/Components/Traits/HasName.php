<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits;

trait HasName
{
    protected function getNameTranslationFromValidation(string|null $locale = null): string
    {
        return __('validation.attributes.' . $this->getNameWithoutArrayNotation())
            . ($locale ? ' (' . strtoupper($locale) . ')' : '');
    }

    protected function getNameWithoutArrayNotation(): string
    {
        return strstr($this->name, '[', true) ?: 'data.' . $this->name;
    }

    protected function getNameWithArrayNotationConvertedInto(string $notation = '.'): string
    {
        return str_replace(['[', ']'], [$notation, ''], 'data.' . $this->name);
    }
}
