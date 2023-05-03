<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits;

trait HasPlaceholder
{
    public function getPlaceholder(string|null $label, string $locale = null): string|null
    {
        if (!$this->placeholder) {
            return null;
        }
        if ($this->placeholder) {
            return $this->placeholder . ($locale ? ' (' . strtoupper($locale) . ')' : '');
        }

        return $label ?: $this->getNameTranslationFromValidation($locale);
    }
}
