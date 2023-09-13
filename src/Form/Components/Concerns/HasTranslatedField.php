<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait HasTranslatedField
{
    protected bool $isTranslate = false;
    protected ?string $lang = NULL;

    public function translate(): static
    {
        $this->isTranslate = config('little-admin-architect.translate.active');

        return $this;
    }

    public function HasTranslated(): bool
    {
        return $this->isTranslate;
    }

    protected function tranlatedLang(string $lang)
    {
        $this->lang = $lang;
    }

    protected function getDefaultTranslatedLang(): string
    {
        return config('little-admin-architect.translate.default');
    }

    protected function getTranslatedLangues(): array
    {
        return config('little-admin-architect.translate.lang');
    }
}
