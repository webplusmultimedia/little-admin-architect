<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

trait HasLabel
{
    protected string|false|null $label = null;
    protected bool $wrappedWithMargin = true;
    protected bool $isRequiredField = false;
    public function getLabel(string|false|null $locale = null): string|null
    {
        $label = $this->getConfig()?->getLabel();
        if ($label === false) {
            return null;
        }
        if ($label) {
            return $label.($locale ? ' ('.strtoupper($locale).')' : '');
        }
        if (! $locale) {
            return str($this->name)->headline()->lower()->ucfirst();
        }

        return str($this->name)->headline()->lower()->ucfirst().($locale ? ' ('.strtoupper($locale).')' : '');

        //return $this->getNameTranslationFromValidation($locale);
    }

    public function isShowSignRequiredOnLabel(): bool
    {
        return $this->isRequiredField;
    }

    public function wrappedWithMargin(): bool
    {
        return $this->wrappedWithMargin;
    }
}
