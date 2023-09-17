<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait HasTranslatedField
{
    protected static bool $isTranslate = false;

    protected static ?string $lang = null;

    public function translate(): static
    {
        static::$isTranslate = config('little-admin-architect.translate.active');

        return $this;
    }

    public static function hasTranslated(): bool
    {
        return config('little-admin-architect.translate.active');
    }

    public static function hasLanguage(string $lang): bool
    {
        return static::hasTranslated() and collect(self::getTranslatedLangues())->filter(fn ($langue) => $langue === $lang)->count();
    }

    public function translatedLang(?string $lang): void
    {
        static::$lang = $lang ?? static::getDefaultTranslatedLang();
    }

    public static function getDefaultTranslatedLang(): string
    {
        return config('little-admin-architect.translate.default');
    }

    public static function getTranslatedLangues(): array
    {
        return config('little-admin-architect.translate.lang');
    }

    public static function getSelectedTranslateLangue(): string
    {
        return static::$lang ?? static::getDefaultTranslatedLang();
    }

    public static function getNotSelectedLanguages(): array
    {
        return collect(static::getTranslatedLangues())->filter(fn ($v) => $v !== static::getSelectedTranslateLangue())->toArray();
    }
}
