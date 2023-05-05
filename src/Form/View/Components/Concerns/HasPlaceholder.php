<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

trait HasPlaceholder
{
    protected string|false|null $placeholder = null;
    public function getPlaceholder(string|null $label, string $locale = null): string|null
    {
        if (! $this->placeholder) {
            return null;
        }
        if ($this->placeholder) {
            return $this->placeholder.($locale ? ' ('.strtoupper($locale).')' : '');
        }

        return $label ?: $this->getNameTranslationFromValidation($locale);
    }
}
