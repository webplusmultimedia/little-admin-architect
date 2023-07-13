<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;

trait HasField
{
    protected Field $field;

    public function getField(): Field
    {
        return $this->field;
    }

    protected function field(Field $field): static
    {
        $this->field = $field;

        return $this;
    }
}
