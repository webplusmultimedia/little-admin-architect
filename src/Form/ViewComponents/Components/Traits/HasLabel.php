<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits;

trait HasLabel
{
    public function getLabel(string|false|null $locale = null): string|null
    {

        if ($this->label === false) {
            return null;
        }
        if ($this->label) {
            return $this->label . ($locale ? ' (' . strtoupper($locale) . ')' : '');
        }
        if (!$locale){
            return  str($this->name)->headline()->lower()->ucfirst();
        }

        return str($this->name)->headline()->lower()->ucfirst() . ($locale ? ' (' . strtoupper($locale) . ')' : '');

        //return $this->getNameTranslationFromValidation($locale);
    }
}
