<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasSelectField;

class SelectFilter extends BaseFilter
{
    use HasSelectField;

    protected function setUp(): array
    {
        $field = Select::make($this->getFilterPath())
            ->reactive(false)
            ->label($this->label);
        $field->setPrefixPath($this->prefixPath);
        $this->configure($field);

        return [$field];
    }
}
