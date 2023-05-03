<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

trait HasSchema
{
    /**
     * @var array<int,Field> $fields
     */
    protected array $fields = [];
    /**
     * @param array<int,Field> $fields
     *
     * @return static
     */
    public function schema(array $fields): static
    {
        $this->fields = $fields;
        return $this;
    }
}
