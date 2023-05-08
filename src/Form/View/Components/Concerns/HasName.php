<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

trait HasName
{
    protected function getNameTranslationFromValidation(string|null $locale = null): string
    {
        return __('validation.attributes.'.$this->getNameWithoutArrayNotation())
            .($locale ? ' ('.mb_strtoupper($locale).')' : '');
    }

    protected function getNameWithoutArrayNotation(): string
    {
        return mb_strstr($this->name, '[', true) ?: 'data-'.$this->name;
    }

    protected function getNameWithArrayNotationConvertedInto(string $notation = '.'): string
    {
        return str_replace(['[', ']'], [$notation, ''], 'data-'.$this->name);
    }
}
