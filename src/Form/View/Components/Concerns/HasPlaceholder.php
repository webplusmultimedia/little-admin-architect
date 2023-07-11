<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

trait HasPlaceholder
{
    protected string|false|null $placeholder = null;

    public function getPlaceholder(?string $label, string $locale = null): ?string
    {
        if ( ! $this->placeholder) {
            return null;
        }
        if ($this->placeholder) {
            return $this->placeholder . ($locale ? ' (' . mb_strtoupper($locale) . ')' : '');
        }

        return $label ?: $this->getNameTranslationFromValidation($locale);
    }
}
