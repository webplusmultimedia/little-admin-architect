<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait HasSchema
{
    /**
     * @var Field[]|AbstractLayout[]
     */
    protected array $fields = [];

    /**
     * @param  Field[]|AbstractLayout[]  $fields
     */
    public function schema(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @return Field[]|AbstractLayout[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
