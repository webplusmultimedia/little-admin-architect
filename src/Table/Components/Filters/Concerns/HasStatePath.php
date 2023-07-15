<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasStatePath
{
    protected string $prefixPath = 'tableFilters';

    protected function getFilterPath(?Field $field = null): string
    {
        if ( ! $field) {
            $path = str($this->name);
            if ( ! blank($this->getLabel())) {
                $path = $path->append('.' . Str::slug($this->getLabel(), '_'));
            }

            return $path->value();
        }
        $name = $field->getName();
        $path = str($name);
        $label = $field->getRawLabel();
        if (blank($label)) {
            $field->label($path->headline()->value());
        }
        $path = $path->append('.value');

        return $path->value();
    }
}
