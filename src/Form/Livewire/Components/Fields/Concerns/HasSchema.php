<?php

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
     * @param  array<int,Field|AbstractLayout>  $fields
     */
    public function schema(array $fields): static
    {

        $this->fields = $fields;

        return $this;
    }
}
