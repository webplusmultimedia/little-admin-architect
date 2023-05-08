<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait HasSchema
{
    /**
     * @var array<int,Field|AbstractLayout >
     */
    protected array $fields = [];

    /**
     * @return Field|AbstractLayout $this
     */
    public function schema(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
