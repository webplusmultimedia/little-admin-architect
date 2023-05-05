<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

use Illuminate\Support\Str;

trait HasId
{
    protected string|null $id = null;
    public function getId(string|null $locale = null, string $suffix = null): string|null
    {
        return $this->id ? $this->id
            .($suffix ? '-'.Str::slug(Str::snake($suffix)) : '')
            .($locale ? '-'.$locale : '') : null;
    }

    public function getDefaultId(string $prefix, string|null $locale = null, string $suffix = null): string
    {
        return Str::slug(Str::snake($prefix))
            .'-'.Str::slug(Str::snake($this->getNameWithArrayNotationConvertedInto('-'), '-'))
            .($suffix ? '-'.Str::slug(Str::snake($suffix)) : '')
            .($locale ? '-'.$locale : '');
    }
}
